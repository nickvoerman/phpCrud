const loginButton = document.querySelector('.js-login');
loginButton.addEventListener('click', loginUser);

function loginUser() {
const username = document.querySelector('.js-username');
const password = document.querySelector('.js-password');

  if(!username.value || !password.value) {
    return console.log("empty fields");
  }

  Request('includes/loginUser.php', "POST", {
    username: username.value,
    password: password.value

  }).then(data => {

    // Check for errors
    if (data.hasOwnProperty("error")) {
      alert(data.error);
      return;
    }

    alert(data.message);
    window.location.href = "index.php";
  })
}

function Request(link, method, data) {

  return new Promise((resolve, reject) => {

    const formdata = new FormData();
    
    // GO over all data items
    for (const key in data) {
      if (data.hasOwnProperty(key)) {
        // Append this key with it's value to formdata
        formdata.append(key, data[key]);
      }
    }
  
    fetch(link, { 
        method: method,
        body: formdata
    }).then(res => {
  
      // Parse the json
      res.json().then(parsedJson => {
        console.log(parsedJson);
        return resolve(parsedJson);
      }).catch(e => {
        console.log(e);
        reject();
      })

    }).catch(e => {
      console.log(e);
      reject();
    })
  })
}
let httpRequest;
document.getElementById("translate").addEventListener('click', makeRequest);

function makeRequest() {
  httpRequest = new XMLHttpRequest();

  if(!httpRequest) {
    console.log("Cant create");
    return false;
  }
  httpRequest.onreadystatechange = () => {
    if(httpRequest.readyState === XMLHttpRequest.DONE) {
      if(httpRequest.status === 200) {
        let engToArab = JSON.parse(httpRequest.responseText);
        let lists = document.getElementsByTagName("ul");
        for(let i=0; i<lists.length; i++) {
          let listItems = lists[i].children;
          for(let j=0; j<listItems.length; j++) {
            let key = listItems[j].getAttribute('id');
            if(key.includes("loginGET")) {
              listItems[j].innerHTML=`<a id="loginGET" href="./GETForm.php" lang="ar" dir="rtl">${engToArab[key]}</a>`
            } else if (key.includes("loginPOST")) {
              listItems[j].innerHTML=`<a id="loginPOST" href="./POSTForm.php" lang="ar" dir="rtl">${engToArab[key]}</a>`
            } else {
              listItems[j].innerHTML=`<span lang="ar" dir="rtl">${engToArab[key]}</span>`
            }
          }
        }
      }
    } else {
      console.log("Request Error");
    }
  };
  httpRequest.open('GET', 'arabic.php');
  httpRequest.send();
}

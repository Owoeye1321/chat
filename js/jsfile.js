//this block of helps to prevent resubmisssion of form
//it however works very well for chrome browser
if(window.history.replaceState)
{                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    window.history.replaceState(null,null,window.location.href)
}    


//this is an ajax query that changes the content of available_groups into groupchatcall page response
//it fetches the display of the goup to chat call and display it in the available content
const groupCall = new XMLHttpRequest()
groupCall.onreadystatechange = function()
{
      if(this.readyState == 4 && this.status == 200)
      {
          document.getElementById("available_groups").innerHTML = this.response;
      }
}
      groupCall.open("GET", "groupToChatCall.php")
      groupCall.send()

 //this block of code uses an ajax query that call friends to chat from the database
//here,all available friends on the site are well displayed here
const xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function()
{
    if (this.readyState == 4 && this.status == 200)
    {
       document.getElementById("demo").innerHTML = this.responseText;
    }  
}
    xhttp.open("GET", "friendsToChatCall.php")
    xhttp.send()

 //this block of code uses an ajax query that call chatted friends
//here,all available chatted friends on the site are well displayed here
const fetch_chat = new XMLHttpRequest();
fetch_chat.onreadystatechange = function()
{
    if (this.readyState == 4 && this.status == 200)
    {
       document.getElementById("fetch_chat").innerHTML = this.responseText;
    }  
}
    fetch_chat.open("GET", "chatted.php")
    fetch_chat.send()



  //this block of code uses an ajax query that call news feeds
  //here,all available feeds on the site are well displayed here

  const fetch_news_feed = new XMLHttpRequest();
  fetch_news_feed.onreadystatechange = function()
  {
     if (this.readyState == 4 && this.status == 200)
  {
     document.getElementById("fetch_news_feed").innerHTML = this.responseText;
  }  
  }
        fetch_news_feed.open("GET", "fetchFeed.php")
        fetch_news_feed.send()

        
//okay,this block of code transition a mainchat id from the body to fetching message from the database
//its changes the content of the mainchat to a database file using ajax
const fetchMessage = new XMLHttpRequest();
fetchMessage.onreadystatechange = function()
{
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("mainchat").innerHTML = this.responseText;
    }  
}
    fetchMessage.open("GET", "fetchmessage.php")
    fetchMessage.send()

    //this is a grou[ that helps to alterate the goupchat id display from the body]
//it then trandition it into a form using ajax call
function reqGroupForm()
{
  const fetchGroupForm = new XMLHttpRequest()
  fetchGroupForm.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("groupchat").innerHTML = this.responseText
    }
  }
    fetchGroupForm.open("GET","groupForm.php")
    fetchGroupForm.send()
}


//this is an ajax request that fetches the content of group message
//it display the result in the group chat message 
const groupChatMessage = new XMLHttpRequest()
groupChatMessage.onreadystatechange = function()
{
  if(this.readyState == 4 && this.status == 200)
  {
     document.getElementById("groupChatMessage").innerHTML = this.response;
  }
} 
groupChatMessage.open("GET","fetchGroupMessage.php")
groupChatMessage.send()



//this is a funnction that uses ajax to request data from the fetch friend profile
//it displays the result in the main chat content
function getUserProfile()
{

  const getUserProfile = new XMLHttpRequest()
  getUserProfile.onreadystatechange = function()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("mainchat").innerHTML = this.responseText
    }
  }
  getUserProfile.open("GET","fetch_friend_profile.php")
  getUserProfile.send()

}




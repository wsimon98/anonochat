<!DOCTYPE html>
<html>
<head>
  <title>American2Day Chat - Every 10th message deletes itself.</title>
  <style>
    body {
      background-color: #0E0E0E;
      color: #FFF;
      font-family: 'Courier New', monospace;
      font-size: 14px;
      margin: 0;
      padding: 20px;
      text-align: center;
    }

    .chat-container {
      display: flex;
      flex-direction: column;
      height: 100vh;
      margin: 0 auto;
      max-width: 600px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
    }

    .message {
      background-color: #0E0E0E;
      border-radius: 4px;
      display: inline-block;
      margin: 10px 0;
      padding: 10px 15px;
      width: fit-content;
    }

    .clear {
      clear: both;
    }
  </style>
</head>
<body>
  <h1>American2Day Chat - Every 10th message deletes itself</h1>
  <div id="chat-area"></div>
  <form action="" method="post">
    <input type="text" name="message" id="message">
    <input type="submit" value="Send">
  </form>

   <script>
    const chatArea = document.getElementById("chat-area");
    const form = document.querySelector("form");
    const messageInput = document.getElementById("message");

    function displayMessages() {
      const xhr = new XMLHttpRequest();
      xhr.open("GET", "load_messages.php", true);
      xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          chatArea.innerHTML = this.responseText;
        }
      };
      xhr.send();
    }

    form.addEventListener("submit", function(e) {
      e.preventDefault();

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "save_message.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          displayMessages();
          messageInput.value = ""; // clear the text input after message is sent
        }
      };
      xhr.send("message=" + encodeURIComponent(messageInput.value));
    });

    setInterval(displayMessages, 1000);
  </script>
</body>
</html>

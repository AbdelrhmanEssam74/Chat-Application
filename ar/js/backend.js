// Create a new WebSocket object and connect it to the server
const conn = new WebSocket("ws://localhost:8080");
// Event handler when the WebSocket connection is successfully established
conn.onopen = function (e) {
  console.log("Connection established !");
  // Send a message to the server
  conn.send("message send from browser client");
};
// Event handler when a message is received from the server
conn.onmessage = function (e) {
  console.log("Message: " + e.data);
  let ul_list = document.querySelector(".message-list");
  let li = document.createElement("li");
  li.innerHTML = e.data;
  ul_list.appendChild(li);
};

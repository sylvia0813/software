import "./bootstrap";

var channel = pusher.subscribe("user.1");
channel.bind("new-message-event", function (data) {
    alert(JSON.stringify(data));
});

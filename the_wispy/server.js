const http = require('http');
const express = require('express');


const app = express();


const server = http.createServer(app);


const io = require('socket.io')(server, {
	cors: { origin: "*"}
});


io.on('connection', (socket)=>{
	console.log('connected');


    

	socket.on('disconnect', (server)=>{
			console.log('Disconnect');
	});
});



server.listen(3000, ()=>{
	console.log('Server is connected to 3000');
});



// const express = require("express");
// const app = express();
// const port = 3000;
// const http = require("http").createServer();
// const io = require("socket.io")(http);
// var users = [];
// io.on("connection", (socket) => {
//     console.log(`connected '${socket.id}'`)
//     socket.on('connectionRequest', (userData) => {
// 		console.log(`userData '${userData.userName}'`)
//         users.push({
//             id: socket.id,
//             userName: userData.userName,
// 			lat: userData.lat,
// 			lng: userData.lng
//         });
		
// 		console.log(JSON.stringify(users));
//         if(users.length==2){
// 			 io.to(users[0].id).emit('onConnectionSucceed', users[1]);
// 			 io.to(users[1].id).emit('onConnectionSucceed', users[0]);
// 			 console.log(JSON.stringify(users));
// 		}
//     });
//     /* socket.on('message', (data) => {
//         socket.broadcast.to(users[0].id).emit('message', {
//             msg: data.msg,
//             name: data.name
//         });
//     }); */
	
// 	socket.on('onLocationReceiver', (data) => {
// 		/* console.log(`onLocationReceiver '${data.socketId}'`) */
//         socket.broadcast.to(data.socketId).emit('onLocationReceiver', {
//             lat: data.lat,
// 			lng: data.lng,
// 			id: data.socketId,
// 			bearing: data.locationBearing,
//         });
//     });
	
// 	socket.on('remove_marker', (data) => {
//         socket.broadcast.to(data.socketId).emit('remove_marker', {
// 			id: socket.id
//         });
//     });
//     socket.emit("welcome", "User connected");
//     socket.on("disconnect", () => {
// 		users.splice(users.findIndex(elem => elem.id === socket.id), 1);
//         console.log("disconnected");
// 	    if(users.length==1){
// 			socket.broadcast.to(users[0].id).emit('remove_marker', {
// 			id: socket.id
//         });
// 		}
//     });
//     // listen for incoming data msg on this newly connected socket
//     socket.on('data', function (data) {
//         console.log(`data received is '${data}'`)
//     });
// });
// http.listen(port, () => {
//     console.log("Server is listenening at port = " + port);
// });
importScripts("https://www.gstatic.com/firebasejs/5.4.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/5.4.0/firebase-messaging.js");

// Initialize Firebase
var config = {
    apiKey: "AIzaSyCpNQnWGAj2z4cpzfqcOYgQ-V8mC2scVkE",
    authDomain: "t2v-cirrus.firebaseapp.com",
    databaseURL: "https://t2v-cirrus.firebaseio.com",
    projectId: "t2v-cirrus",
    storageBucket: "t2v-cirrus.appspot.com",
    messagingSenderId: "744149347141"
};
firebase.initializeApp(config);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload){
	console.log('setBackgroundMessageHandler', payload);
	// const title = 'Hello World';
	// const options = {
	// 	body: payload.data.status
	// }
	// var notificationTitle = 'Background Message Title';
 //  	var notificationOptions = {
	//     body: 'Background Message body.',
	//     icon: '/firebase-logo.png'
 //  	};
	// return self.registration.showNotification(title, options);
})
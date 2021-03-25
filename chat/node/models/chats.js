var mongoose = require('mongoose');
var UserSchema = new mongoose.Schema({
    user: { type: String },
    name: { type: String },
    company: { type: Number },
    status: { type: Number, default: 0 },
    list: [{ type: mongoose.Schema.Types.ObjectId, ref: 'User' }]
});

mongoose.model('User', UserSchema);

var ChatSchema = new mongoose.Schema({
    chat_id: { type: String },
    sender: { type: String },
    receiver: { type: String },
    company: { type: Number },
    date: { type: Date, default: Date.now},
    messages: [{ type: mongoose.Schema.Types.ObjectId, ref: 'Message' }]
});

mongoose.model('Chat', ChatSchema);

var MessageSchema = new mongoose.Schema({
    chat_id: { type: mongoose.Schema.Types.ObjectId, ref: 'Chat' },
    user: { type: String },
    person: { type: String },
    date: { type: Date, default: Date.now},
    message: { type: String },
    status: { type: Number, default: 0 }
});

mongoose.model('Message', MessageSchema);
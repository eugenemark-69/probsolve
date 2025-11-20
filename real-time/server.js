// real-time/server.js
// Simple Socket.io server for Probsolve
const { Server } = require('socket.io');
const http = require('http');

const server = http.createServer();
const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST']
    }
});

io.on('connection', (socket) => {
    console.log('User connected:', socket.id);

    // Chat message relay
    socket.on('chat_message', (data) => {
        io.emit('chat_message', data);
    });

    // Notification relay
    socket.on('notification', (data) => {
        io.emit('notification', data);
    });

    // Problem/solution updates
    socket.on('problem_update', (data) => {
        io.emit('problem_update', data);
    });
    socket.on('solution_submitted', (data) => {
        io.emit('solution_submitted', data);
    });

    socket.on('disconnect', () => {
        console.log('User disconnected:', socket.id);
    });
});

const PORT = process.env.SOCKET_PORT || 3000;
server.listen(PORT, () => {
    console.log(`Socket.io server running on port ${PORT}`);
});

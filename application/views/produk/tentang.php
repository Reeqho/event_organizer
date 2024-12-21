<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        h1, h4 {
            margin-bottom: 20px;
        }
        table {
            margin-bottom: 20px;
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            background-color: white;
            border-radius: 25px;
            box-shadow: 0 8px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
        table, th, td {
            border: none;
            padding: 15px;
            text-align: left;
        }
        td {
            background-color: white;
        }
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .qr-chat-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 20px;
        }
        .chat-box {
            width: 300px;
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
        }
        .chat-input {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .chat-input select,
        .chat-input input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .chat-input button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .chat-message {
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .message-content {
            display: flex;
            gap: 5px;
        }
        .sender-label {
            font-weight: bold;
            color: #007bff;
        }
        .delete-btn {
            padding: 5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="h3 mb-2 text-gray-800">Tentang Kami</h1>
    <table class="table table-bordered" cellspacing="0">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>Seven Organizer</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>Madiun, Jawa Timur</td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td>Penyedia jasa event & wedding lengkap dengan harga merakyat</td>
        </tr>
    </table>

    <h4>Informasi Selengkapnya</h4>

    <div class="qr-chat-container">
        <div id="qrcode"></div>

        <div>
            <div class="chat-box" id="chatBox"></div>

            <div class="chat-input" id="chatInputContainer">
                <select id="senderType">
                    <option value="customer">Pelanggan</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="text" id="chatInput" placeholder="Ketik pesan di sini...">
                <button onclick="sendMessage()">Kirim</button>
            </div>

            <button onclick="clearChat()">Hapus Semua Pesan</button>
        </div>
    </div>
</div>

<script>
    var info = `Seven Organizer, yang berpusat di Madiun, Jawa Timur, adalah 
    pilihan terpercaya untuk layanan event dan wedding yang lengkap dengan harga terjangkau. 
    Kami menghadirkan solusi praktis untuk setiap detail acara Anda, mulai dari dekorasi hingga koordinasi, 
    dengan sentuhan profesional dan personal. Dengan komitmen menghadirkan pengalaman terbaik, 
    kami siap membantu mewujudkan momen impian Anda. Follow Instagram kami di @se7en.wo_madiun untuk 
    melihat portofolio dan penawaran spesial. Percayakan acara Anda kepada Seven Organizer, 
    dan rasakan sendiri kualitas layanan kami!`;

    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: info,
        width: 250,
        height: 250
    });

    function loadChat() {
        const chatBox = document.getElementById('chatBox');
        chatBox.innerHTML = '';
        let messages = JSON.parse(localStorage.getItem('chatMessages')) || [];
        messages.forEach((messageObj, index) => {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('chat-message');
            
            const contentDiv = document.createElement('div');
            contentDiv.classList.add('message-content');
            
            const senderLabel = document.createElement('span');
            senderLabel.classList.add('sender-label');
            senderLabel.textContent = `${messageObj.sender === 'admin' ? 'Admin' : 'Pelanggan'}:`;

            const messageText = document.createElement('span');
            messageText.textContent = messageObj.message;

            contentDiv.appendChild(senderLabel);
            contentDiv.appendChild(messageText);

            const deleteBtn = document.createElement('button');
            deleteBtn.classList.add('delete-btn');
            deleteBtn.textContent = 'Hapus';
            deleteBtn.onclick = () => deleteMessage(index);

            messageDiv.appendChild(contentDiv);
            messageDiv.appendChild(deleteBtn);
            chatBox.appendChild(messageDiv);
        });
    }

    function sendMessage() {
        const chatInput = document.getElementById('chatInput');
        const senderType = document.getElementById('senderType').value;
        let messageText = chatInput.value;
        if (messageText.trim() !== '') {
            let messages = JSON.parse(localStorage.getItem('chatMessages')) || [];
            messages.push({ sender: senderType, message: messageText });
            localStorage.setItem('chatMessages', JSON.stringify(messages));
            loadChat();
            chatInput.value = '';
        }
    }

    function deleteMessage(index) {
        let messages = JSON.parse(localStorage.getItem('chatMessages')) || [];
        messages.splice(index, 1);
        localStorage.setItem('chatMessages', JSON.stringify(messages));
        loadChat();
    }

    function clearChat() {
        localStorage.removeItem('chatMessages');
        loadChat();
    }

    window.onload = function() {
        loadChat();
    };
</script>

</body>
</html>

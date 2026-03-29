<div class="ai-chatbot-container" id="aiChatbotContainer">
    <!-- Floating Button -->
    <div class="chatbot-btn shadow-lg animate__animated animate__bounceInUp" id="chatbotBtn">
        <div class="btn-inner">
            <i class="fas fa-robot"></i>
            <span class="pulse"></span>
        </div>
    </div>

    <!-- Chat Window -->
    <div class="chat-window shadow-2xl d-none" id="chatWindow">
        <div class="chat-header">
            <div class="d-flex align-items-center gap-3">
                <div class="bot-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-white">Expedition Bot</h6>
                    <small class="text-white-50">Go Deep Africa Guide</small>
                </div>
            </div>
            <button class="btn-close btn-close-white" id="closeChat"></button>
        </div>
        
        <div class="chat-messages" id="chatMessages">
            <div class="message bot">
                <div class="message-bubble">
                    Jambo! I am your Go Deep Africa Expedition Bot. How can I help you plan your dream Tanzanian safari today? 🦁
                </div>
            </div>
        </div>

        <div class="chat-input-area">
            <div class="quick-replies mb-2">
                <button class="btn btn-sm btn-outline-earth rounded-pill me-1 mb-1 quick-reply" data-msg="Safari Packages">Safari Packages</button>
                <button class="btn btn-sm btn-outline-earth rounded-pill me-1 mb-1 quick-reply" data-msg="Kilimanjaro Routes">Kilimanjaro Routes</button>
                <button class="btn btn-sm btn-outline-earth rounded-pill me-1 mb-1 quick-reply" data-msg="Zanzibar Trips">Zanzibar Trips</button>
            </div>
            <div class="input-group">
                <input type="text" class="form-control border-0 bg-light rounded-pill px-4" id="userInput" placeholder="Ask me anything...">
                <button class="btn btn-earth rounded-circle ms-2" id="sendMessage">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .ai-chatbot-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1050;
    }

    .chatbot-btn {
        width: 65px;
        height: 65px;
        background: linear-gradient(135deg, #8b4513 0%, #3E2723 100%);
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        transition: all 0.3s ease;
        border: 4px solid rgba(255,255,255,0.2);
    }

    .chatbot-btn:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 10px 25px rgba(139, 69, 19, 0.4);
    }

    .btn-inner {
        position: relative;
    }

    .pulse {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 12px;
        height: 12px;
        background: #28a745;
        border-radius: 50%;
        border: 2px solid white;
        animation: chatbotPulse 2s infinite;
    }

    @keyframes chatbotPulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }

    .chat-window {
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 380px;
        height: 550px;
        background: white;
        border-radius: 25px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transform-origin: bottom right;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .chat-header {
        background: linear-gradient(135deg, #3E2723 0%, #8b4513 100%);
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .bot-avatar {
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
    }

    .chat-messages {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background: #fdfaf5;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .message {
        max-width: 85%;
        display: flex;
    }

    .message.bot { align-self: flex-start; }
    .message.user { align-self: flex-end; }

    .message-bubble {
        padding: 12px 18px;
        border-radius: 20px;
        font-size: 0.95rem;
        line-height: 1.5;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .message.bot .message-bubble {
        background: white;
        color: #333;
        border-bottom-left-radius: 5px;
    }

    .message.user .message-bubble {
        background: #8b4513;
        color: white;
        border-bottom-right-radius: 5px;
    }

    .chat-input-area {
        padding: 20px;
        background: white;
        border-top: 1px solid #eee;
    }

    .btn-outline-earth {
        border-color: #8b4513;
        color: #8b4513;
        font-size: 0.8rem;
    }

    .btn-outline-earth:hover {
        background-color: #8b4513;
        color: white;
    }

    .btn-earth {
        background-color: #8b4513;
        border: none;
        color: white;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 576px) {
        .chat-window {
            width: calc(100vw - 40px);
            right: -10px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatbotBtn = document.getElementById('chatbotBtn');
    const chatWindow = document.getElementById('chatWindow');
    const closeChat = document.getElementById('closeChat');
    const sendMessage = document.getElementById('sendMessage');
    const userInput = document.getElementById('userInput');
    const chatMessages = document.getElementById('chatMessages');
    const quickReplies = document.querySelectorAll('.quick-reply');

    // Toggle Chat
    chatbotBtn.addEventListener('click', () => {
        chatWindow.classList.toggle('d-none');
        if (!chatWindow.classList.contains('d-none')) {
            userInput.focus();
        }
    });

    closeChat.addEventListener('click', () => {
        chatWindow.classList.add('d-none');
    });

    // Handle Messages
    function addMessage(text, type) {
        const div = document.createElement('div');
        div.className = `message ${type} animate__animated animate__fadeInUp`;
        div.innerHTML = `<div class="message-bubble">${text}</div>`;
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function handleSend() {
        const text = userInput.value.trim();
        if (text) {
            addMessage(text, 'user');
            userInput.value = '';
            
            // Simulating AI Response
            setTimeout(() => {
                let response = "That's a great question! Our Go Deep Africa specialists are ready to help you with that. Would you like us to send you a customized safari quote?";
                
                if (text.toLowerCase().includes('safari')) {
                    response = "We offer amazing safaris to Serengeti, Ngorongoro, and Tarangire! 🦒 Which park interests you most?";
                } else if (text.toLowerCase().includes('kili') || text.toLowerCase().includes('mountain')) {
                    response = "Mount Kilimanjaro is the roof of Africa! 🏔️ We specialize in Machame and Lemosho routes. Are you looking for a 6 or 7 day trek?";
                } else if (text.toLowerCase().includes('zanzibar')) {
                    response = "Zanzibar's beaches are paradise! 🏖️ We have great spice tour and beach packages. Ready for some sun?";
                }
                
                addMessage(response, 'bot');
            }, 1000);
        }
    }

    sendMessage.addEventListener('click', handleSend);
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleSend();
    });

    quickReplies.forEach(btn => {
        btn.addEventListener('click', () => {
            userInput.value = btn.getAttribute('data-msg');
            handleSend();
        });
    });
});
</script>

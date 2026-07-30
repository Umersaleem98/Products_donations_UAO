@if(session('show_cookie_popup'))

<style>
.cookie-popup {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 430px;
    max-width: calc(100vw - 30px);
    z-index: 999999;
    animation: cookieSlideIn .5s ease;
}

.cookie-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,.15);
    border: 1px solid #e5e7eb;
}

.cookie-header {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color: white;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.cookie-icon {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: rgba(255,255,255,.15);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 26px;
}

.cookie-title {
    font-size: 20px;
    font-weight: 700;
    margin: 0;
}

.cookie-subtitle {
    font-size: 13px;
    opacity: .8;
    margin-top: 3px;
}

.cookie-body {
    padding: 25px;
}

.cookie-body p {
    margin: 0;
    color: #64748b;
    line-height: 1.8;
    font-size: 14px;
}

.cookie-actions {
    display: flex;
    gap: 12px;
    padding: 0 25px 25px;
}

.cookie-btn {
    flex: 1;
    border: none;
    cursor: pointer;
    border-radius: 12px;
    padding: 13px;
    font-weight: 600;
    transition: .3s;
}

.cookie-btn:hover {
    transform: translateY(-2px);
}

.cookie-accept {
    color: white;
    background: linear-gradient(135deg,#2563eb,#06b6d4);
}

.cookie-reject {
    background: #f8fafc;
    color: #334155;
    border: 1px solid #dbe3ee;
}

.cookie-footer {
    text-align: center;
    padding: 0 25px 20px;
    color: #94a3b8;
    font-size: 12px;
}

@keyframes cookieSlideIn {
    from {
        opacity: 0;
        transform: translateY(80px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media(max-width:768px) {

    .cookie-popup {
        right: 15px;
        left: 15px;
        width: auto;
        bottom: 15px;
    }

    .cookie-actions {
        flex-direction: column;
    }
}
</style>

<div id="cookieModal" class="cookie-popup">

    <div class="cookie-card">

        <div class="cookie-header">

            <div class="cookie-icon">
                🍪
            </div>

            <div>
                <div class="cookie-title">
                    Your Privacy Matters
                </div>

                <div class="cookie-subtitle">
                    Secure • Transparent • User Friendly
                </div>
            </div>

        </div>

        <div class="cookie-body">

            <p>
                We use cookies to enhance your browsing experience, improve website
                performance, remember your preferences, and better understand how
                visitors interact with our platform. You can accept or decline
                optional cookies at any time.
            </p>

        </div>

        <div class="cookie-actions">

            <button type="button"
                    class="cookie-btn cookie-reject"
                    onclick="rejectCookies()">
                Decline
            </button>

            <button type="button"
                    class="cookie-btn cookie-accept"
                    onclick="acceptCookies()">
                Accept & Continue
            </button>

        </div>

        <div class="cookie-footer">
            By continuing to use this website, you agree to our use of essential cookies.
        </div>

    </div>

</div>

<script>
function closeCookiePopup() {
    let popup = document.getElementById('cookieModal');

    if (popup) {
        popup.style.transition = "0.3s";
        popup.style.opacity = "0";
        popup.style.transform = "translateY(50px)";

        setTimeout(() => {
            popup.remove();
        }, 300);
    }
}

function acceptCookies() {

    fetch("{{ url('/cookie-accept') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json",
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        closeCookiePopup();
    })
    .catch(error => {
        console.error(error);
    });
}

function rejectCookies() {

    fetch("{{ url('/cookie-reject') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json",
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        closeCookiePopup();
    })
    .catch(error => {
        console.error(error);
    });
}
</script>

@endif

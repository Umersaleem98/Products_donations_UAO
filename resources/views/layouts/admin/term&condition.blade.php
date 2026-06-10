<style>
    .nsn-modal .modal-dialog {
        max-width: 550px;
    }

    .nsn-modal .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,.15);
    }

    .nsn-header {
        background: linear-gradient(135deg, #306DB0, #24558B);
        padding: 25px;
        text-align: center;
        color: #fff;
        position: relative;
    }

    .nsn-icon {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        font-size: 28px;
    }

    .nsn-body {
        padding: 30px;
        text-align: center;
    }

    .nsn-body h4 {
        color: #306DB0;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .nsn-body p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .terms-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 18px;
        text-align: left;
        margin-bottom: 25px;
    }

    .terms-card ul {
        margin: 0;
        padding-left: 18px;
    }

    .terms-card li {
        margin-bottom: 10px;
        color: #555;
        font-size: 14px;
        line-height: 1.6;
    }

    .accept-wrapper {
        background: #FFF8E8;
        border: 1px solid #FABC4D;
        border-radius: 12px;
        padding: 14px;
        display: flex;
        justify-content: center;
    }

    .accept-wrapper .form-check {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin: 0;
    }

    .accept-wrapper .form-check-input {
        margin-top: 3px;
        flex-shrink: 0;
    }

    .accept-wrapper .form-check-label {
        color: #333;
        font-weight: 500;
        text-align: left;
        font-size: 14px;
        line-height: 1.5;
    }

    .nsn-btn {
        background: #306DB0;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 12px 35px;
        font-weight: 600;
        min-width: 220px;
        transition: .3s;
    }

    .nsn-btn:hover {
        background: #24558B;
        color: #fff;
    }

    .nsn-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
    }

    @media (max-width: 576px) {
        .nsn-body {
            padding: 20px;
        }

        .nsn-btn {
            width: 100%;
            min-width: unset;
        }
    }
</style>

<div class="modal fade nsn-modal"
     id="donorTermsModal"
     tabindex="-1"
     data-bs-backdrop="true"
     data-bs-keyboard="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <!-- HEADER -->
            <div class="nsn-header">

                <!-- CLOSE BUTTON -->
                <button type="button"
                        class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>

                <div class="nsn-icon">
                    <i class="fas fa-handshake"></i>
                </div>

                <h4 class="mt-3 mb-0">
                    NUST Sharing Network
                </h4>

            </div>

            <form action="{{ route('donor.accept.terms') }}" method="POST">
                @csrf

                <!-- BODY -->
                <div class="nsn-body">

                    <h4>Terms & Conditions</h4>

                    <p>
                        The NUST Sharing Network enables secure resource sharing within
                        the NUST community. By continuing, you agree to the following
                        terms that ensure transparency, trust, and responsible usage.
                    </p>

                    <div class="terms-card">

                        <ul>
                            <li>
                                All information provided must be accurate and verified by the user.
                            </li>

                            <li>
                                Contact details will only be shared after a request is approved by the system.
                            </li>

                            <li>
                                The platform maintains records of requests, approvals, and exchanges for transparency and auditing.
                            </li>

                            <li>
                                Misuse of the platform or submission of false information may result in account restrictions.
                            </li>

                            <li>
                                Users must respect privacy and maintain professional communication at all times.
                            </li>
                        </ul>

                    </div>

                    <!-- ACCEPT BOX -->
                    <div class="accept-wrapper">

                        <div class="form-check">

                            <input type="checkbox"
                                   class="form-check-input"
                                   id="acceptTerms">

                            <label class="form-check-label"
                                   for="acceptTerms">
                                I agree to the Terms & Conditions of the NUST Sharing Network.
                            </label>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="text-center pb-4">

                    <button type="submit"
                            id="agreeBtn"
                            class="nsn-btn"
                            disabled>
                        Accept & Continue
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const modalElement = document.getElementById('donorTermsModal');

    if (modalElement) {

        const modal = new bootstrap.Modal(modalElement);
        modal.show();

        const checkbox = document.getElementById('acceptTerms');
        const button = document.getElementById('agreeBtn');

        checkbox.addEventListener('change', function () {
            button.disabled = !this.checked;
        });
    }
});
</script>

<style>

    /* ================= PROFESSIONAL ALERT ================= */

    .custom-alert{
        position: fixed;
        top: 25px;
        right: 25px;
        min-width: 340px;
        max-width: 450px;
        padding: 18px 20px;
        border-radius: 14px;
        color: #fff;
        z-index: 99999;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        box-shadow: 0 10px 35px rgba(0,0,0,0.15);
        animation: slideInRight 0.5s ease;
        overflow: hidden;
    }

    .custom-alert::after{
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 100%;
        background: rgba(255,255,255,0.4);
        animation: progressBar 5s linear forwards;
    }

    /* SUCCESS */
    .alert-success-custom{
        background: linear-gradient(135deg, #00b09b, #96c93d);
    }

    /* ERROR */
    .alert-error-custom{
        background: linear-gradient(135deg, #ff416c, #ff4b2b);
    }

    /* ICON */
    .custom-alert i{
        font-size: 24px;
        margin-top: 2px;
    }

    /* CONTENT */
    .alert-content{
        flex: 1;
    }

    .alert-title{
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .alert-message{
        font-size: 14px;
        line-height: 1.5;
    }

    /* CLOSE BUTTON */
    .alert-close{
        cursor: pointer;
        font-size: 20px;
        opacity: 0.8;
        transition: 0.3s;
        line-height: 1;
    }

    .alert-close:hover{
        opacity: 1;
        transform: scale(1.1);
    }

    /* ANIMATION */

    @keyframes slideInRight{

        from{
            transform: translateX(120%);
            opacity: 0;
        }

        to{
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fadeOut{

        to{
            transform: translateX(120%);
            opacity: 0;
        }
    }

    @keyframes progressBar{

        from{
            width: 100%;
        }

        to{
            width: 0%;
        }
    }

</style>


<!-- ================= SUCCESS ALERT ================= -->

@if(session('success'))

<div class="custom-alert alert-success-custom" id="alertBox">

    <i class="mdi mdi-check-circle"></i>

    <div class="alert-content">

        <div class="alert-title">
            Success
        </div>

        <div class="alert-message">
            {{ session('success') }}
        </div>

    </div>

    <span class="alert-close" onclick="closeAlert()">
        &times;
    </span>

</div>

@endif


<!-- ================= ERROR ALERT ================= -->

@if($errors->any())

<div class="custom-alert alert-error-custom" id="alertBox">

    <i class="mdi mdi-alert-circle"></i>

    <div class="alert-content">

        <div class="alert-title">
            Validation Error
        </div>

        <div class="alert-message">

            @foreach($errors->all() as $error)

                <div>{{ $error }}</div>

            @endforeach

        </div>

    </div>

    <span class="alert-close" onclick="closeAlert()">
        &times;
    </span>

</div>

@endif


<script>

    // AUTO HIDE ALERT

    setTimeout(() => {

        const alertBox = document.getElementById('alertBox');

        if(alertBox){

            alertBox.style.animation = 'fadeOut 0.5s ease forwards';

            setTimeout(() => {

                alertBox.remove();

            }, 500);
        }

    }, 5000);


    // MANUAL CLOSE

    function closeAlert(){

        const alertBox = document.getElementById('alertBox');

        if(alertBox){

            alertBox.style.animation = 'fadeOut 0.5s ease forwards';

            setTimeout(() => {

                alertBox.remove();

            }, 500);
        }
    }

</script>

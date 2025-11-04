<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Başvuru Beyoğlu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom.css">
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #2563eb;
            --secondary-color: #10b981;
            --background-color: #f3f4f6;
            --sidebar-color: #1f2937;
            --text-color: #374151;
            --text-light: #6b7280;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background-color: var(--sidebar-color);
            color: var(--white);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--text-light);
            text-decoration: none;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-item:hover, .nav-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }

        .nav-item svg {
            margin-right: 1rem;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--white);
            padding: 1.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-bottom: 2rem;
        }

        .user-info {
            display: flex;
            align-items: left;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            margin-left: 1rem;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .sidebar-close {
            display: none;
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Profil sayfası için ek stiller */
        .profile-content {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            margin-top: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--text-color);
        }

        .profile-info {
            display: grid;
            gap: 1rem;
        }

        .info-group {
            display: grid;
            grid-template-columns: 150px 1fr;
            align-items: center;
        }

        .info-group label {
            font-weight: 500;
            color: var(--text-light);
        }

        .edit-profile-button, .save-profile-button, .cancel-edit-button {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.3s ease;
            margin-top: 2rem;
        }

        .edit-profile-button:hover, .save-profile-button:hover {
            background-color: var(--primary-dark);
        }

        .cancel-edit-button {
            background-color: var(--text-light);
            margin-left: 1rem;
        }

        .cancel-edit-button:hover {
            background-color: var(--text-color);
        }

        .editable-field {
            padding: 0.5rem;
            border: 1px solid var(--text-light);
            border-radius: 4px;
            font-size: 1rem;
            min-width: 150px;
        }

        .non-editable {
            background-color: var(--background-color);
            color: var(--text-light);
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                z-index: 1000;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-close {
                display: block;
            }

            .main-content {
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-info {
                margin-top: 0.5rem;
            }

            .sidebar-toggle {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1001;
            }

            .pageheader {
                font-size: 1.5em !important;
            }

            .formheader {
                font-size: 1.5em !important;
            }
        }


    </style>

    <style>

        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px; /* Form genişliğini artırdık */
        }

        .formheader {
            text-align: center;
            color: #333;
            font-size: 28px; /* Başlık boyutunu büyüttük */
        }

        .step {
            display: none;
            animation: fadeIn 0.5s;
        }

        .step.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        label {
            display: block;
            margin-top: 15px;
            color: #666;
        }

        input {
            width: 100%;
            padding: 12px; /* Input alanlarını büyüttük */
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px; /* Input yazı boyutunu büyüttük */
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 24px; /* Buton boyutunu büyüttük */
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px; /* Buton yazı boyutunu büyüttük */
        }

        button:hover {
            background-color: #45a049;
        }

        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .progress-bar {
            width: 100%;
            height: 12px; /* İlerleme çubuğunu büyüttük */
            background-color: #ddd;
            border-radius: 6px;
            margin-top: 30px;
            overflow: hidden;
        }

        .progress {
            width: 0;
            height: 100%;
            background-color: #4CAF50;
            transition: width 0.5s;
        }

        #confetti {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
        }

        .success-banner {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 24px;
            margin-top: 20px;
            border-radius: 4px;
        }

        .thank-you-message {
            text-align: center;
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }
    </style>

    <style>
        .step {
            margin-bottom: 20px;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 15px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
        }

        .checkbox-item input[type="checkbox"] {
            width: 1.3rem;
            height: 1.3rem;
            margin-right: 5px;
            margin-top: 0px;
        }

        .checkbox-item label {
            margin-top: 0;
        }

        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 15px;
        }

        .radio-item {
            display: flex;
            align-items: center;
        }

        .radio-item input[type="radio"] {
            width: 20px !important;
            height: 20px !important;
            margin-right: 5px;
            margin-top: 0px;
        }

        .radio-item label {
            margin-top: 0;
        }
    </style>

    <style>
        #loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .selectform {
            width: 4rem;
            height: 2.5rem;
            font-size: 16px;
            padding: 8px;
            margin-top: 0.5rem;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

@include('partials.sidebar')

<div id="loading-spinner" style="display: none; ">
    <div class="spinner"></div>
</div>

<main class="main-content">
    <header class="header">
        <div style="display: flex; align-items: center; gap: 1.5rem;">
            <img src="https://beyoglu.bel.tr/wp-content/uploads/2020/05/header-logo-3.png"
                 alt="Beyoğlu Belediyesi"
                 style="height: 80px; width: auto;">
            <div>
                <h1 class="pageheader">Başvuru</h1>
                <div class="user-info" style="margin-bottom: 0px">
                    <div>
                        <div style="font-weight: 600;">{{$student->name}} {{$student->surname}}</div>
                        <div style="color: var(--text-light); font-size: 0.875rem;"><a>{{$student->identity}}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @if($enroll_details != null)
        <div class="form-container">
            <h3>BAŞVURUM</h3> <br>

            @foreach($enroll_details as $key => $enroll_detail)
                @php $form_field = \Illuminate\Support\Facades\DB::table('form_fields')->where('id', $enroll_detail->form_field_id)->first() @endphp
                @php $arr = json_decode($enroll_detail->form_field_value, true) @endphp

                <h4>{{$form_field->question}}</h4>

                @if(is_array($arr))
                    {{$arr[0]}}, {{$arr[1]}}, {{$arr[2]}}
                @elseif($form_field->field_type == 'file')
                    <a href="/uploads/forms/{{$enroll_detail->form_field_value}}" target="_blank">Görüntüle</a>
                @else
                    {{$enroll_detail->form_field_value}}
                @endif
                <br> <br>

            @endforeach

            <h4>Başvuru Durumu: @if($enroll->statu == 0) <span style="color: #aca407">Onay Bekliyor</span> @elseif($enroll->statu == 1) <span style="color: #4CAF50">Onaylandı</span> @elseif($enroll->statu == 2) <span style="color: #8B0000">İptal Edildi</span> @endif</h4>

        </div>
        <br>
    @endif


    <div class="form-container">

        <div style="text-align: center">
            <img src="table-tennis.png" style="height: 100px" alt="">
        </div>
        <h1 class="formheader">Masa Tenisi Turnuvası Başvurusu</h1> <br>

        @if(\Carbon\Carbon::parse($student->birthday)->age < 7)

            <p style="text-align: center">Masa tenisi turnuvasına 7 yaş ve üstü vatandaşlarımız katılabilmektedir.</p>

            <div style="text-align: center; margin-top: 2rem">
                <img src="heart.png" style="width: 100px" alt="">
            </div>

        @elseif($student->phone == null)

            <p style="text-align: center">Başvuru yapmak için öncelikle kişisel bilgilerinizi doldurmalısınız.</p> <br>
            <br>
            <div style="text-align: center">
                <button class='apply-button' style='width: 160px'><a href='/profile'
                                                                     style='text-decoration: none; color: white'>Profil
                        Güncelle</a></button>
            </div>

        @else

            <form id="basketballForm">
                <input type="hidden" name="formid" value="4">


                <div class="step active" data-step="1">
                    <h3>Turnuvaya Katılacak Oyuncu</h3>
                    <label for="field_20_name">Adı:</label>
                    <input type="text" id="field_20_name" name="field_20_name" required>
                    <label for="field_20_surname">Soyadı:</label>
                    <input type="text" id="field_20_surname" name="field_20_surname" required>
                    <label for="field_20_identity">Kimlik Numarası:</label>
                    <input type="text" id="field_20_identity" name="field_20_identity"  pattern="\d{11}" title="11 haneli TC Kimlik Numarası" required>
                    <label for="field_20_birthday">Doğum Tarihi:</label>
                    <input type="date" id="field_20_birthday" name="field_20_birthday" required>
                    <label for="field_20_phone">Telefon:</label>
                    <input type="text" id="field_20_phone" name="field_20_phone" class="phone-input" pattern="\d{10}" required>
                    <input type="hidden" id="field_20_gender" name="field_20_gender" value="0">
                    <input type="hidden" id="field_20_town" name="field_20_town" value="0">
                </div>
                <div class="step" data-step="2">
                    <h3>Acil Durumda Aranacak Kişi</h3>
                    <label for="field_21_name">Adı:</label>
                    <input type="text" id="field_21_name" name="field_21_name" required>
                    <label for="field_21_surname">Soyadı:</label>
                    <input type="text" id="field_21_surname" name="field_21_surname" required>
                    <label for="field_21_identity">Kimlik Numarası:</label>
                    <input type="text" id="field_21_identity" name="field_21_identity"  pattern="\d{11}" title="11 haneli TC Kimlik Numarası" >
                    <label for="field_21_birthday">Doğum Tarihi:</label>
                    <input type="date" id="field_21_birthday" name="field_21_birthday" >
                    <label for="field_21_phone">Telefon:</label>
                    <input type="text" id="field_21_phone" name="field_21_phone" class="phone-input" pattern="\d{10}" required>
                    <input type="hidden" id="field_21_gender" name="field_21_gender" value="">
                    <input type="hidden" id="field_21_town" name="field_21_town" value="">
                </div>

                <div class="step" data-step="3">
                    <h3>Sağlınız ile ilgili olumsuz bir durum var mı?</h3>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="field_22_1" name="field_22_" onclick="toggleAciklama('var')" value="Var" required>
                            <label for="field_14_1">Var</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="field_22_2" name="field_22_" onclick="toggleAciklama('yok')" value="Yok" required>
                            <label for="field_14_2">Yok</label>
                        </div>
                    </div>

                    <div id="saglikaciklama" style="display: none">
                        <label for="field_23">Açıklayınız</label>
                        <input type="text" id="field_23_" name="field_23_">
                    </div>
                </div>

                <div class="step" data-step="4">
                    <h3>Masa Tenisi lisansınız var mı?</h3>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="field_24_1" name="field_24_" value="Var" required>
                            <label for="field_24_1">Var</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="field_24_2" name="field_24_" value="Yok" required>
                            <label for="field_24_2">Yok</label>
                        </div>
                    </div>
                </div>

                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
                <div class="buttons">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)" disabled>Geri</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">İleri</button>
                </div>
            </form>

            <div id="successMessage" style="display: none;">
                <div class="success-banner">Başvurunuz Alındı</div>
                <p class="thank-you-message">Masa Tenisi Turnuvası başvurunuz alınmıştır. Başvurunuz değerlendirildikten sonra
                    tarafınıza bilgi verilecektir. Başarılar dileriz.</p>

                <div style="text-align: center; margin-top: 2rem">
                    <img src="heart.png" style="width: 100px" alt="">
                </div>
            </div>
    </div>
    <canvas id="confetti"></canvas>

    @endif

</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

<script>
    function toggleAciklama(secim) {
        const aciklamaDiv = document.getElementById('saglikaciklama');
        const aciklamaInput = document.getElementById('aciklama_input');

        if (secim === 'var') {
            aciklamaDiv.style.display = 'block';
            aciklamaInput.required = true;
        } else if (secim === 'yok') {
            aciklamaDiv.style.display = 'none';
            aciklamaInput.required = false;
            aciklamaInput.value = '';
        }
    }
</script>


<script>
    let currentStep = 1;
    const totalSteps = 4;

    function nextPrev(n) {
        const steps = document.querySelectorAll('.step');
        const currentStepElement = document.querySelector(`.step[data-step="${currentStep}"]`);
        const nextStepElement = document.querySelector(`.step[data-step="${currentStep + n}"]`);

        if (n === 1 && !validateStep(currentStepElement)) return false;

        if(n === 1 && currentStep === 2 && (document.getElementById('field_20_birthday').value > '2018-09-16')){
            alert("Masa tenisi turnuvasına 7 yaş ve üstü vatandaşlarımız katılabilmektedir.");
            exit;
        }

        if(n === 1 && document.getElementById('field_20_identity').value === document.getElementById('field_21_identity').value){
            alert("Aynı T.C. Kimlik numarası girdiniz.");
            exit;
        }

        if((n === 1 && currentStep === 1) || (n === 1 && currentStep === 2)) {


            if(currentStep === 2) {
                identity = document.getElementById('field_21_identity').value;
                birthday = document.getElementById('field_21_birthday').value;

                currentStepElement.classList.remove('active');
                currentStep += n;

                nextStepElement.classList.add('active');
                updateButtons();
                updateProgressBar();
            } else {
                identity = document.getElementById('field_20_identity').value;
                birthday = document.getElementById('field_20_birthday').value;
                $('#loading-spinner').show();

            let token = '@csrf';
            token = token.substr(42, 40);

                $.ajax({
                    type: "post",
                    url: `/formenrollcheck`,
                    data: { _token: token, identity: identity, form_field_id: 20 },
                    success: function (data) {
                        document.getElementById('loading-spinner').style.display = 'none';
                        if (data === "true") {
                            alert("Bu kişinin başvurusu daha önce alınmış.");
                            window.stop();
                            exit();
                            debugger;
                        }
                    },
                    error: function(err) {
                        document.getElementById('loading-spinner').style.display = 'none';
                        console.log( "hata x168613" );
                        exit;
                        debugger;
                    }
                });



            $.ajax({
                type: "post",
                url: `/formkpsbridge`,
                data: { _token: token, identity: identity, birthday: birthday},
                success: function (data) {
                    document.getElementById('loading-spinner').style.display = 'none';
                    if (data === "kimlikhata") {
                        alert("Kimlik bilgileri hatalı!");
                        window.stop();
                        exit();
                    } else {

                        if(currentStep === 2) {
                            document.getElementById('field_21_name').value = data['name'];
                            document.getElementById('field_21_surname').value = data['surname'];
                            document.getElementById('field_21_gender').value = data['gender'];
                            document.getElementById('field_21_town').value = data['town'];
                        } else {
                            document.getElementById('field_20_name').value = data['name'];
                            document.getElementById('field_20_surname').value = data['surname'];
                            document.getElementById('field_20_gender').value = data['gender'];
                            document.getElementById('field_20_town').value = data['town'];
                        }

                        currentStepElement.classList.remove('active');
                        currentStep += n;

                        if (currentStep > totalSteps) {
                            submitForm();
                            return false;
                        }

                        nextStepElement.classList.add('active');
                        updateButtons();
                        updateProgressBar();


                        console.log(data);
                    }

                },
                error: function(err) {

                    document.getElementById('loading-spinner').style.display = 'none';
                    console.log( "hata x887135" );
                    exit;
                    debugger;
                }
            });


            }


        } else {
            currentStepElement.classList.remove('active');
            currentStep += n;

            if (currentStep > totalSteps) {
                submitForm();
                return false;
            }

            nextStepElement.classList.add('active');
            updateButtons();
            updateProgressBar();
        }



    }

    function validateStep(step) {
        const inputs = step.querySelectorAll('input[required]');
        let isValid = true;
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                input.reportValidity();
                isValid = false;
            }
        });

        // Kimlik numarası kontrolü
        if (isValid && step.querySelector('input[name$="Id"]')) {
            isValid = validateUniqueIds();
        }

        return isValid;
    }

    function validateUniqueIds() {
        const idInputs = document.querySelectorAll('input[name$="Id"]');
        const ids = new Set();
        for (let input of idInputs) {
            if (input.value && ids.has(input.value)) {
                alert('Her oyuncunun kimlik numarası benzersiz olmalıdır!');
                input.focus();
                return false;
            }
            if (input.value) {
                ids.add(input.value);
            }
        }
        return true;
    }

    function updateButtons() {
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        prevBtn.disabled = currentStep === 1;
        nextBtn.innerHTML = currentStep === totalSteps ? 'Başvuruyu Tamamla' : 'İleri';
    }

    function updateProgressBar() {
        const progress = document.querySelector('.progress');
        const percentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progress.style.width = `${percentage}%`;
    }

    function submitForm() {
        if (!validateUniqueIds()) {
            return;
        }
        $('#loading-spinner').show();
        const formData = new FormData(document.getElementById('basketballForm'));

        const formObject = Object.fromEntries(formData.entries());
        console.log('Form Bilgileri:', formObject);

        // AJAX isteği
        fetch('/insertformanswer', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#loading-spinner').hide();
                    console.log(formData);
                    // Konfeti animasyonu
                    confetti({
                        particleCount: 100,
                        spread: 70,
                        origin: { y: 0.6 }
                    });

                    // Butonları ve ilerleme çubuğunu gizle
                    document.querySelector('.buttons').style.display = 'none';
                    document.querySelector('.progress-bar').style.display = 'none';

                    // Başarı mesajını göster
                    document.getElementById('successMessage').style.display = 'block';
                } else {
                    $('#loading-spinner').hide();
                    alert(data.message);
                }
            })
            .catch(error => {
                $('#loading-spinner').hide();
                console.error('Error:', error);
                alert('Bir hata oluştu. Lütfen tekrar deneyin.');
            });
    }

    // Doğum tarihi için maksimum değer ayarlama
    const today = new Date().toISOString().split('T')[0];
    const birthdateInputs = document.querySelectorAll('input[type="date"]');
    birthdateInputs.forEach(input => {
        input.max = today;
    });
</script>

<script>

    document.querySelectorAll('.nav-item').item(6).classList.add('active');


    // Sidebar toggle işlevselliği
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebar = document.getElementById('sidebar');

    function toggleSidebar() {
        sidebar.classList.toggle('active');
        if (sidebar.classList.contains('active')) {
            sidebarToggle.style.display = 'none';
        } else {
            sidebarToggle.style.display = 'block';
        }
    }

    sidebarToggle.addEventListener('click', toggleSidebar);
    sidebarClose.addEventListener('click', toggleSidebar);

    document.addEventListener('click', (event) => {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnToggle = sidebarToggle.contains(event.target);

        if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth <= 768 && sidebar.classList.contains('active')) {
            toggleSidebar();
        }
    });


</script>

<script>

    // Telefon doğrulama sınıfı
    class PhoneValidator {
        constructor() {
            this.phoneFields = new Set();
            this.init();
        }

        init() {
            // Mevcut telefon alanlarını bul ve kaydet
            this.findPhoneInputs();
            // Event listener'ları ekle
            this.addEventListeners();
        }

        findPhoneInputs() {
            const phoneInputs = document.querySelectorAll('.phone-input');
            phoneInputs.forEach(input => {
                this.phoneFields.add(input);
                this.setupPhoneField(input);
            });
        }

        setupPhoneField(input) {
            // Input event
            input.addEventListener('input', (e) => this.handleInput(e));
            // Paste event
            input.addEventListener('paste', (e) => this.handlePaste(e));
            // Keypress event (sadece rakam)
            input.addEventListener('keypress', (e) => this.handleKeypress(e));
        }

        addEventListeners() {
            // Form submit

        }

        handleInput(e) {
            let value = e.target.value;

            // Sadece rakamları tut
            value = value.replace(/[^0-9]/g, '');

            // Başında 0 varsa sil
            if (value.startsWith('0')) {
                value = value.substring(1);
            }

            // 10 karakterle sınırla
            if (value.length > 10) {
                value = value.substring(0, 10);
            }

            // Input değerini güncelle
            e.target.value = value;

            // Doğrulama ve görsel güncelleme
            this.validateAndUpdateField(e.target);
        }

        handlePaste(e) {
            setTimeout(() => {
                let value = e.target.value.replace(/[^0-9]/g, '');

                if (value.startsWith('0')) {
                    value = value.substring(1);
                }

                if (value.length > 10) {
                    value = value.substring(0, 10);
                }

                e.target.value = value;
                this.validateAndUpdateField(e.target);
            }, 10);
        }

        handleKeypress(e) {
            if (!/[0-9]/.test(e.key) &&
                !['Backspace', 'Delete', 'Tab', 'Escape', 'Enter', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                e.preventDefault();
            }
        }

        validatePhone(phone) {
            const onlyNumbers = /^[0-9]+$/.test(phone);
            const isCorrectLength = phone.length === 10;
            const doesntStartWithZero = phone.charAt(0) !== '0';

            return {
                isValid: onlyNumbers && isCorrectLength && doesntStartWithZero,
                onlyNumbers,
                isCorrectLength,
                doesntStartWithZero
            };
        }

        getErrorMessage(phone, validation) {
            if (phone.length === 0) return '';

            if (!validation.onlyNumbers) {
                return 'Sadece rakam girebilirsiniz!';
            }

            if (phone.length < 10) {
                return `${10 - phone.length} rakam daha girmelisiniz!`;
            }

            return '';
        }

        formatPhoneDisplay(phone) {
            if (phone.length === 0) {
                return '--- --- -- --';
            }

            let formatted = phone;

            if (phone.length >= 3) {
                formatted = phone.substring(0, 3) + ' ' + phone.substring(3);
            }
            if (phone.length >= 6) {
                formatted = phone.substring(0, 3) + ' ' + phone.substring(3, 6) + ' ' + phone.substring(6);
            }
            if (phone.length >= 8) {
                formatted = phone.substring(0, 3) + ' ' + phone.substring(3, 6) + ' ' + phone.substring(6, 8) + ' ' + phone.substring(8);
            }

            return formatted;
        }

        validateAndUpdateField(input) {
            const value = input.value;
            const validation = this.validatePhone(value);

            // Mesaj elementlerini bul
            const errorElement = document.querySelector(`[data-error-for="${input.id}"]`);
            const successElement = document.querySelector(`[data-success-for="${input.id}"]`);
            const formatElement = document.querySelector(`[data-for="${input.id}"]`);

            // Mesajları temizle
            if (errorElement) errorElement.textContent = '';
            if (successElement) successElement.textContent = '';

            // CSS sınıflarını temizle
            input.classList.remove('error', 'success');

            // Format gösterimini güncelle
            if (formatElement) {
                formatElement.textContent = this.formatPhoneDisplay(value);
            }

            if (value.length > 0) {
                if (validation.isValid) {
                    input.classList.add('success');
                    if (successElement) {
                        successElement.textContent = '✅ Geçerli telefon numarası!';
                    }
                } else {
                    input.classList.add('error');
                    if (errorElement) {
                        errorElement.textContent = this.getErrorMessage(value, validation);
                    }
                }
            }
        }

        handleSubmit(e) {
            e.preventDefault();

            let isFormValid = true;
            const phoneData = {};

            // Tüm telefon alanlarını kontrol et
            this.phoneFields.forEach(input => {
                const value = input.value;
                const isRequired = input.hasAttribute('required');
                const validation = this.validatePhone(value);

                if (isRequired && value.length === 0) {
                    isFormValid = false;
                    alert(`${input.previousElementSibling.textContent} alanı zorunludur!`);
                    return;
                }

                if (value.length > 0 && !validation.isValid) {
                    isFormValid = false;
                    alert(`${input.previousElementSibling.textContent} alanındaki telefon numarası geçersiz!`);
                    return;
                }

                if (value.length > 0) {
                    phoneData[input.name] = value;
                }
            });

            if (isFormValid) {
                console.log('Form verileri:', phoneData);
                alert('✅ Form başarıyla gönderildi!\n\n' +
                    Object.entries(phoneData)
                        .map(([key, value]) => `${key}: ${this.formatPhoneDisplay(value)}`)
                        .join('\n'));
            }
        }

        // Yeni telefon alanı ekleme
        addNewPhoneField(container, id, label, required = false) {
            const phoneField = document.createElement('div');
            phoneField.className = 'phone-field';
            phoneField.innerHTML = `
                    <div class="input-group">
                        <label for="${id}">${label} ${required ? '<span class="required">*</span>' : ''}</label>
                        <input
                            type="tel"
                            id="${id}"
                            name="${id}"
                            class="phone-input"
                            placeholder="5321234567"
                            maxlength="10"
                            ${required ? 'required' : ''}
                        >
                        <div class="format-display" data-for="${id}">--- --- -- --</div>
                        <div class="error-message" data-error-for="${id}"></div>
                        <div class="success-message" data-success-for="${id}"></div>
                    </div>
                `;

            container.appendChild(phoneField);

            // Yeni input'u kaydet ve setup et
            const newInput = phoneField.querySelector('.phone-input');
            this.phoneFields.add(newInput);
            this.setupPhoneField(newInput);

            return newInput;
        }
    }

    // Global değişkenler
    let phoneValidator;
    let dynamicPhoneCounter = 5;

    // Sayfa yüklendiğinde başlat
    document.addEventListener('DOMContentLoaded', function() {
        phoneValidator = new PhoneValidator();
    });

    // Dinamik telefon alanı ekleme fonksiyonu
    function addPhoneField() {
        const container = document.getElementById('dynamicPhones');
        const newId = `phone${dynamicPhoneCounter}`;
        const label = `Telefon ${dynamicPhoneCounter}`;

        phoneValidator.addNewPhoneField(container, newId, label);
        dynamicPhoneCounter++;
    }

</script>



</body>
</html>

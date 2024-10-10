<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>هيكل الأسنان</title>
    <style>
        .teeth {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 80px; /* إضافة مسافة بين الفكين */
        }
        .row {
            display: flex;
            justify-content: center;
            margin: 5px 0;
        }
        .tooth {
            width: 30px;
            height: 40px;
            border: 1px solid #000;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2px;
            border-radius: 15px 15px 5px 5px;
            position: relative;
            background: #fff; /* إضافة لون خلفية للأسنان */
            cursor: pointer; /* إضافة مؤشر اليد عند التمرير */
        }
        .tooth.active {
            background: #0f0; /* اللون الأخضر عند التفعيل */
        }
        .tooth::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -10px;
            width: 10px;
            height: 10px;
            background: #000;
            border-radius: 50%;
        }
        .tooth:last-child::after {
            display: none;
        }
        .upper-jaw {
            transform: rotate(180deg);
        }
        .boolean-dot {
            width: 10px;
            height: 10px;
            background: #000;
            border-radius: 50%;
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            cursor: pointer;
        }
        .boolean-dot.active {
            background: #0f0; /* اللون الأخضر عند التفعيل */
        }
    </style>
</head>
<body>
    <form id="teethForm" action="{{ route('teeth1') }}" method="POST">
        @csrf
        <input type="hidden" name="case_id" value="{{ session('case_id') }}">
        <div class="teeth">
            <div class="row upper-jaw">
                <div class="tooth" data-tooth="1">
                    <div class="boolean-dot"></div>
                    1
                </div>
                <div class="tooth" data-tooth="2">
                    <div class="boolean-dot"></div>
                    2
                </div>
                <div class="tooth" data-tooth="3">
                    <div class="boolean-dot"></div>
                    3
                </div>
                <div class="tooth" data-tooth="4">
                    <div class="boolean-dot"></div>
                    4
                </div>
                <div class="tooth" data-tooth="5">
                    <div class="boolean-dot"></div>
                    5
                </div>
                <div class="tooth" data-tooth="6">
                    <div class="boolean-dot"></div>
                    6
                </div>
                <div class="tooth" data-tooth="7">
                    <div class="boolean-dot"></div>
                    7
                </div>
                <div class="tooth" data-tooth="8">
                    <div class="boolean-dot"></div>
                    8
                </div>
                <div class="tooth" data-tooth="9">
                    <div class="boolean-dot"></div>
                    9
                </div>
                <div class="tooth" data-tooth="10">
                    <div class="boolean-dot"></div>
                    10
                </div>
                <div class="tooth" data-tooth="11">
                    <div class="boolean-dot"></div>
                    11
                </div>
                <div class="tooth" data-tooth="12">
                    <div class="boolean-dot"></div>
                    12
                </div>
                <div class="tooth" data-tooth="13">
                    <div class="boolean-dot"></div>
                    13
                </div>
                <div class="tooth" data-tooth="14">
                    <div class="boolean-dot"></div>
                    14
                </div>
                <div class="tooth" data-tooth="15">
                    <div class="boolean-dot"></div>
                    15
                </div>
                <div class="tooth" data-tooth="16">
                    <div class="boolean-dot"></div>
                    16
                </div>
            </div>
            <div class="row">
                <div class="tooth" data-tooth="17">
                    <div class="boolean-dot"></div>
                    17
                </div>
                <div class="tooth" data-tooth="18">
                    <div class="boolean-dot"></div>
                    18
                </div>
                <div class="tooth" data-tooth="19">
                    <div class="boolean-dot"></div>
                    19
                </div>
                <div class="tooth" data-tooth="20">
                    <div class="boolean-dot"></div>
                    20
                </div>
                <div class="tooth" data-tooth="21">
                    <div class="boolean-dot"></div>
                    21
                </div>
                <div class="tooth" data-tooth="22">
                    <div class="boolean-dot"></div>
                    22
                </div>
                <div class="tooth" data-tooth="23">
                    <div class="boolean-dot"></div>
                    23
                </div>
                <div class="tooth" data-tooth="24">
                    <div class="boolean-dot"></div>
                    24
                </div>
                <div class="tooth" data-tooth="25">
                    <div class="boolean-dot"></div>
                    25
                </div>
                <div class="tooth" data-tooth="26">
                    <div class="boolean-dot"></div>
                    26
                </div>
                <div class="tooth" data-tooth="27">
                    <div class="boolean-dot"></div>
                    27
                </div>
                <div class="tooth" data-tooth="28">
                    <div class="boolean-dot"></div>
                    28
                </div>
                <div class="tooth" data-tooth="29">
                    <div class="boolean-dot"></div>
                    29
                </div>
                <div class="tooth" data-tooth="30">
                    <div class="boolean-dot"></div>
                    30
                </div>
                <div class="tooth" data-tooth="31">
                    <div class="boolean-dot"></div>
                    31
                </div>
                <div class="tooth" data-tooth="32">
                    <div class="boolean-dot"></div>
                    32
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="treatment_id">معرف العلاج</label>
            <input id="treatment_id" class="form-control" type="number" name="treatment_id" required />
        </div>
        <div class="form-group">
            <label for="material_id">معرف المادة</label>
            <input id="material_id" class="form-control" type="number" name="material_id" required />
        </div>
        <div class="card-footer">
            <button class="btn btn-outline-success col d-flex justify-content-center" type="button" onclick="redirectToCases()">h</button>

        </div>
    </form>
    <script>
     document.querySelectorAll('.boolean-dot, .tooth').forEach(element => {
    element.addEventListener('click', () => {
        element.classList.toggle('active');
    });
});

        document.getElementById('teethForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const selectedTeeth = [];
            const selectedDots = [];
            document.querySelectorAll('.tooth').forEach(tooth => {
                const toothNumber = tooth.getAttribute('data-tooth');
                const isActive = tooth.classList.contains('active');
                const dotActive = tooth.querySelector('.boolean-dot').classList.contains('active') ? 1 : 0;
                if (isActive) {
                    selectedTeeth.push([toothNumber, 2, 1]); // يمكنك تعديل القيم حسب الحاجة
                }
                selectedDots.push(dotActive);
            });

            const formData = new FormData(this);
            formData.append('tooth_number', JSON.stringify(selectedTeeth));
            formData.append('bridge', JSON.stringify(selectedDots));

            fetch(this.action, {
                method: this.method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => response.json())
              .then(data => {
                  console.log(data);
                  // يمكنك إضافة أي عملية بعد الاستجابة هنا
              }).catch(error => {
                  console.error(error);
              });
        });
        function redirectToCases() {
        window.location.href = "{{ route('Cases') }}";
    }
    </script>
</body>
</html>

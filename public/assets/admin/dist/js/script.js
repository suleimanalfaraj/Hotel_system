


  // table of invoecise 
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });



  
  // جلب بيانات الدول من ملف JSON
  fetch('/countries.json')
    .then(response => response.json())
    .then(countries => {
        const nationalitySelect = document.getElementById('nationality');

        // إضافة الدول كخيارات إلى قائمة الجنسية
        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country;
            option.textContent = country;
            nationalitySelect.appendChild(option);
        });
    })
  .catch(error => console.error('حدث خطأ أثناء جلب البيانات:', error));

    // دالة لتصفية الشقق حسب حالتها index.reservtion
    function filterReservations(status) {
      const cards = document.querySelectorAll('.reservation-card');
      cards.forEach(card => {
          if (status === 'all') {
              card.style.display = 'block';
          } else if (card.getAttribute('data-status') === status) {
              card.style.display = 'block';
          } else {
              card.style.display = 'none';
          }
      });
  }

  // data for page create reservation 
  $(document).ready(function() {
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd", // صيغة التاريخ المطلوبة
        minDate: 0, // لا يمكن اختيار تاريخ في الماضي

        onSelect: function(dateText) {
          // الحصول على الوقت الحالي
          var currentTime = new Date();
          var currentHour = currentTime.getHours();
          var currentMinute = currentTime.getMinutes();
          var formattedTime = currentHour.toString().padStart(2, '0') + ":" + currentMinute.toString().padStart(2, '0');

          // دمج التاريخ والوقت في الحقل
          var fullDateTime = dateText + " " + formattedTime;

          // تعيين التاريخ والوقت في حقل input
          $(this).val(fullDateTime); // تعيين القيمة في الحقل
      }

    });
})


document.getElementById('setLoginTimeButton').addEventListener('click', function() {
  // الحصول على الوقت الحالي
  const currentTime = new Date().toISOString().slice(0, 16);  // نحصل على الوقت الحالي بصيغة ISO (yyyy-mm-ddThh:mm)

  // تعيين الوقت الحالي إلى حقل "login_time"
  document.getElementById('login_time').value = currentTime;
});

// code index reservtion 
function filterApartments(status) {
  const apartments = document.querySelectorAll('.apartment');

  apartments.forEach(apartment => {
      if (status === 'all') {
          apartment.style.display = 'block';
      } else if (status === 'available') {
          apartment.style.display = apartment.classList.contains('available') ? 'block' : 'none';
      } else if (status === 'occupied') {
          apartment.style.display = apartment.classList.contains('occupied') ? 'block' : 'none';
      }
  });
}



// JavaScript لتحديث السعر تلقائيًا 

    document.getElementById('room_id').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const roomPrice = selectedOption.getAttribute('data-price');
        
        // إذا كان هناك سعر، قم بتحديث الحقل، وإلا أعده فارغًا
        document.getElementById('price').value = roomPrice ? roomPrice : '';
    });


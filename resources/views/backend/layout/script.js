


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
    });
})

document.addEventListener('DOMContentLoaded', function() {
    var categorySelect = document.getElementById('categorySelect');
    var tableRows = document.querySelectorAll('table tbody tr');

    categorySelect.addEventListener('change', function() {
        var selectedCategory = this.value;
        tableRows.forEach(function(row) {
            if(selectedCategory == '0' || row.getAttribute('data-category') === selectedCategory) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

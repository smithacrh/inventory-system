/* Theme and Dark Mode */
function toggleTheme() {
    const html = document.documentElement;
    if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        html.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
}

/* Load Theme on Page Load */
document.addEventListener('DOMContentLoaded', function() {
    const theme = localStorage.getItem('theme') || 'light';
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    }
});

/* Notification Functions */
function showSuccess(message) {
    Swal.fire({
        title: 'Berhasil!',
        text: message,
        icon: 'success',
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
}

function showError(message) {
    Swal.fire({
        title: 'Gagal!',
        text: message,
        icon: 'error',
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
}

function showWarning(message) {
    Swal.fire({
        title: 'Peringatan!',
        text: message,
        icon: 'warning',
        timer: 2000,
        timerProgressBar: true
    });
}

function showInfo(message) {
    Swal.fire({
        title: 'Informasi',
        text: message,
        icon: 'info',
        timer: 2000,
        timerProgressBar: true
    });
}

/* Confirm Dialog */
function showConfirm(title, message, callback) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            callback(true);
        } else {
            callback(false);
        }
    });
}

/* Format Number */
function formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}

/* Format Currency */
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

/* Format Date */
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

/* Loading Spinner */
function showLoading() {
    Swal.fire({
        title: 'Loading',
        html: '<div class="spinner border" role="status"><span class="sr-only">Loading...</span></div>',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function hideLoading() {
    Swal.close();
}

/* Debounce Function */
function debounce(func, delay) {
    let timeoutId;
    return function(...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func(...args), delay);
    };
}

/* Print Function */
function printElement(elementId) {
    const printContent = document.getElementById(elementId).innerHTML;
    const originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
}

/* Export to CSV */
function exportToCSV(filename, data) {
    let csv = '';
    for (let row of data) {
        csv += row.join(',') + '\n';
    }
    
    const link = document.createElement('a');
    link.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
    link.download = filename + '.csv';
    link.click();
}

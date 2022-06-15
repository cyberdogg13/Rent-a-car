document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('#btn-one').addEventListener('click', function () {
        html2canvas(document.querySelector('#factuur')).then((canvas) => {
            let base64image = canvas.toDataURL('image/png');
            // console.log(base64image);
            let pdf = new jsPDF('p', 'px', [680, 950]);
            pdf.addImage(base64image, 'PNG', 15, 15, 644, 894);
            pdf.save('factuur.pdf');
        });
    });
});
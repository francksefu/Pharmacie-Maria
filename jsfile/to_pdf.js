window.jsPDF = window.jspdf.jsPDF;

var doc = new jsPDF();


const elementHTML = document.querySelector("#print");
doc.html(elementHTML, {
    callback: function(doc) {
        // Save the PDF
        doc.save('sample-document.pdf');
    },
    x: 15,
    y: 15,
    width: 170, //target width in the PDF document
    windowWidth: 650 //window width in CSS pixels
});

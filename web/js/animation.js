$(() => {
    const text = "Грузовозофф!";
    const element = $(".main-text");
    let i = 0;

    function typeWriter() {
        if (i < text.length) {
            element.html(`${element.html()}${text.charAt(i)}`);
            i++;
            setTimeout(typeWriter, 300);
        } else {
            setTimeout(() => {
                element.html("")
                i = 0;
                typeWriter()
            }, 1500);
        }
    }
    typeWriter();
});
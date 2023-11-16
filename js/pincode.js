const inputContainer = document.querySelector(".input-container");
const firstInput = inputContainer.children[0];

inputContainer.addEventListener("input", (e) => {
    if (e.target.matches("input[type='number']")) {
        const digit = e.target.value;
        const nextElement = e.target.nextElementSibling;
        if (nextElement) {
            nextElement.focus();
        }

        if (digit.length > 1) {
            e.target.value = digit[e.target.value.length - 1];
        }
    }
})

inputContainer.addEventListener("keydown", (e) => {
    if (e.target.matches("input[type='number']")) {
        if (e.key === "Backspace") {
            e.preventDefault();
            if (e.target.value) e.target.value = "";
            const prevElement = e.target.previousElementSibling;
            if (prevElement) {
                prevElement.focus();
            }
        }
    }
})

firstInput.addEventListener("paste", (e) => {
    e.preventDefault();
    const pasteValue = e.clipboardData.getData("text/plain");
    if (isNaN(+pasteValue)) {
        console.log("NaN")
        e.target.value = "";
        this.focus();
    } else {
        if (pasteValue.length >= code.length) {
            for (let i = 0, j = 0; i < pasteValue && j < inputContainer.children.length; i++, j++) {
                inputContainer.children[j].value = pasteValue[i];
            }
        }
    }
})
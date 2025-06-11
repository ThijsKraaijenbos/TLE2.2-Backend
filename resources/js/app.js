import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//crappy piece of code to handle the copy button on the dev account panel to copy your API-key
let copyIconDiv = document.getElementById("copy-icon-div")

const clickHandler = () => {
    let copyIconPath = document.getElementById("copy-icon-path")
    let copyText = document.getElementById("outputToken")
    copyText.select();
    navigator.clipboard.writeText(copyText.value);

    copyIconPath.style.fill = "#4ade80"
    setTimeout(() =>
        copyIconPath.style.fill = "#2c2e30", 1000
    )

}
copyIconDiv.addEventListener("click", () => clickHandler())

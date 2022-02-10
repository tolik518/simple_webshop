let flags = document.getElementsByClassName("flag");
let flagArray = [];
for (let i = 0; i < flags.length; i++) {
    flagArray.push(document.getElementById(flags[i].id));
}
flagArray.forEach((flag) => {
    flag.addEventListener("mouseover", (e) => {
        let bg_flag = document.getElementById("bg_" + flag.id);
        bg_flag.style.transition = "0.25s";
        bg_flag.style.opacity = "1";
    });
    flag.addEventListener("mouseout", () => {
        let bg_flag = document.getElementById("bg_" + flag.id);
        bg_flag.style.opacity = "0";
    });
});

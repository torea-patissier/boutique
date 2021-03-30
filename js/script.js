function showhide()
{
    // Je stocke dans ma var x le Get Element
    var x = document.getElementById("repondreQuestion");

    // Si x === display none (voir index.php)
    if(x.style.display ==="none"){
        // Alors j'affiche la balise article
        x.setAttribute("style", "display:block");
    }else{
        // Sinon cad, si je click à nouveau, je la cache
        x.setAttribute("style", "display:none");

    }
}

var tabButtons=document.querySelectorAll(".tab-container .button-tab-container button");
var tabPanels=document.querySelectorAll(".tab-container  .tab-painel");

function showPanel(panelIndex,colorCode) {
    tabButtons.forEach(function(node){
        node.style.backgroundColor="";
        node.style.color="";
    });
    tabButtons[panelIndex].style.backgroundColor=colorCode;
    tabButtons[panelIndex].style.color="white";
    tabPanels.forEach(function(node){
        node.style.display="none";
    });
    tabPanels[panelIndex].style.display="block";
}

showPanel(0,'#4596b4');
function saveTextAsFile() {
    var textToWrite = document.getElementById("result").value;
    var textFileAsBlob = new Blob([textToWrite], {type:'text/plain'});
    var fileNameToSaveAs = "DoWszystkich.xml";
    

    var downloadLink = document.createElement("a");
    downloadLink.download = fileNameToSaveAs;
    downloadLink.innerHTML = "DoWszystkich - filtr skrzynki posredniczacej.";

    window.URL = window.URL || window.webkitURL;  
    downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
    downloadLink.onclick = destroyClickedElement;
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
    
}

function destroyClickedElement(event)
{
    document.body.removeChild(event.target);
}

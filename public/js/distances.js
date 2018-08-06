function loadDistances() {    
    renderListHeader();
    var route = document.getElementById("calculateRoute").innerHTML;
    var parameter = "/?address=" + jQuery("#select_city > option:selected").val();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = renderDistances;
    xhttp.open("GET", route + parameter, true);
    xhttp.send();
}

function renderDistances() {

    if (this.readyState === 4 && this.status === 200) {
        var data = JSON.parse(this.responseText);

        jQuery(".city-list ul").remove();
        var ul = document.createElement("ul");
        ul.classList.add("list-group");

        jQuery.each(data, function (index, value) {
            var li = document.createElement("li");
            li.classList.add("list-group-item");
            li.classList.add("d-flex");
            li.classList.add("justify-content-between");
            li.classList.add("align-items-center");
            li.append(index);
            var span = document.createElement("span");
            span.classList.add("badge");
            span.classList.add("badge-primary");
            span.classList.add("badge-pill");
            span.append(value);
            li.append(span);
            ul.appendChild(li);
        });
        jQuery(".city-list").append(ul);

    }

}

function renderListHeader(){
    
    if (jQuery('#select_city > option:selected').val() !== "") {
        jQuery("#listHeader span").remove();
        var span = document.createElement("span");
        span.classList.add("badge");
        span.classList.add("badge-primary");
        span.classList.add("badge-pill");
        span.append("Distance, km");
        jQuery("#listHeader li").append(span);
    } else {
        jQuery("#listHeader span").remove();
        var span = document.createElement("span");
        span.classList.add("badge");
        span.classList.add("badge-primary");
        span.classList.add("badge-pill");
        span.classList.add("mr-5");
        span.append("lat / lng");
        jQuery("#listHeader li").append(span);
    }
}
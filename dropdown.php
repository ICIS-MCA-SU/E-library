<!DOCTYPE html>
<html lang="en-US">
<head>

    <meta charset="UTF-8">

    <title>
        Exp
    </title>


</head>

<body>

<div class="form-group required">
    <label for="InputLastName">For how many hours ? <sup>*</sup> </label>
    <select name="serviceHours" id="hours" onChange="getHours()">
        <option value="" selected>---------</option>
        <option value="1">1 Hour</option>
        <option value="2">2 Hours</option>
        <option value="3">3 Hours</option>
        <option value="4">4 Hours</option>
        <option value="5">5 Hours</option>
        <option value="6">6 Hours</option>
        <option value="7">7 Hours</option>
        <option value="8">8 Hours</option>
        <option value="9">9 Hours</option>
        <option value="10">10 Hours</option>
        <option value="11">11 Hours</option>
        <option value="12">12 Hours</option>
    </select>

</div>

<script type="text/javascript">
    function getHours(){
        var hours = document.getElementById("hours").value;
        alert(hours);
    }
</script>

</body>

</html>
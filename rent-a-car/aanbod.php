<?php
include 'core/init.php';
include 'includes/overall/header.php';
$filtertype = 'merk';
echo $filtertype;
?>
<link rel="stylesheet" href="css/aanbod.css">
<h1>Ons aanbod</h1>

<!--<button class="filter">Filter</button>-->
<!--<p>sorteren op</p>-->
<!--<form action="" method="post">-->
<!--    <select id="cars" name="filtertype" class="filtertype">-->
<!--        <option value="merk">merk</option>-->
<!--        <option value="prijs">prijs</option>-->
<!--        <option value="type">type</option>-->
<!--    </select> <br> <br>-->
<!--    <input type="submit" value="filter" class="filter">-->
<!--</form>-->

<p>
    <?php
    echo "<h2>beschikbare auto's: " . total_avalible_cars() . "</h2><br>";
    ?>
</p>
<div id="aanbodcontent">
    <?php
        get_cars();
    ?>
</div>
<script>
    const aanbodContent = document.querySelector('#aanbodcontent');
    document.querySelector('.filter').addEventListener('click', function(){
            const sortParamenter = <?php echo json_encode($filtertype) ?>;
           // const offset = (pageId - 1) * results_per_page;

            const inputData = {sortParameter: sortParamenter};
            fetch('sort_cars.php', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json'
                },
                body: JSON.stringify(inputData)
            })
                .then((response) => response.json())
                .then(data => {
                    //leeggooien container
                    clearElement(aanbodContent);
                    //vullen container
                    addCars(data, aanbodContent);

                })
    });
    function addCars(data, parentElement){
        for(const[key, value] of Object.entries(data)){
            addCar(value, parentElement);
        }
        //console.log(data);
        //while
    }
    function addCar(data, parentElement){
        parentElement.insertAdjacentHTML('beforeend',   `
                                   <div class="kaart">
<p>${data.merk}</p>
</div>` );

    }
    function clearElement(parentElement){
        while(parentElement.firstElementChild) parentElement.removeChild(parentElement.firstElementChild);
    }

</script>
<?php
include 'includes/overall/footer.php'; ?>

<style>
    html {
        --size: min(calc(90vw / 18), calc(90vh / 7));
        background: black;
    }

    body {
        width: 100%;
    }

    .table {
        position: relative;
        width: calc(var(--size) * 18);
        margin: 0 auto;
    }

    .row {
        width: 100%;
        display: flex;
    }

    .cell {
        width: var(--size);
        height: var(--size);
        background: var(--image);
        background-size: cover;
    }

    .gap {
        flex: 1;
    }

    .f-block {
        width: var(--size);
        height: var(--size);
        display: flex;
        flex-wrap: wrap;
    }

    .f-block .cell {
        width: calc(var(--size) / 4);
        height: calc(var(--size) / 4);
    }

    .table::before {
        content: "";
        display: block;
        position: absolute;
        top: 0px;
        left: calc(var(--size) * 2);
        background: pink;
        background: var(--image);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        width: calc(var(--size) * 10);
        height: calc(var(--size) * 3);
    }

    @media (max-width: 1000px) {
        html {
            --size: calc(90vw / 7);
        }

        .table::before {
            display: none;
        }

        .table {
            width: calc(7 * var(--size));
            height: calc(32 * var(--size));
            display: flex;
            flex-direction: row-reverse;
        }

        .f-block {
            height: calc(15 * var(--size))
        }

        .f-block .cell {
            width: var(--size);
            height: var(--size);
        }

        .row {
            width: var(--size);
            height: calc(32 * var(--size));
            display: flex;
            flex-direction: column;
        }
    }

    @media (max-width: 800px) {
        html {
            --size: 90vw;
        }

        .table::before {
            display: none;
        }

        .table {
            width: var(--size);
            display: block;
        }

        .row {
            display: initial;
            height: unset;
        }

        .gap {
            display: none;
        }

        .cell, .f-block .cell {
            width: var(--size);
            height: calc(191 / 516 * var(--size));
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
    }

</style>
<!--
    Need to have the periodic table as a struct
H               He
Li	Be			B	C	N	O	F	Ne
Na	Mg          Al	Si	P	S	Cl	Ar
K	Ca      	Sc	Ti	V	Cr	Mn	Fe	Co	Ni	Cu	Zn	Ga	Ge	As	Se	Br	Kr
Rb	Sr          Y	Zr	Nb	Mo	Tc	Ru	Rh	Pd	Ag	Cd	In	Sn	Sb	Te	I	Xe
Cs	Ba	La	Ce	Pr	Nd	Pm	Sm	Eu	Gd	Tb	Dy	Ho	Er	Tm	Yb	Lu	Hf	Ta	W	Re	Os	Ir	Pt	Au	Hg	Tl	Pb	Bi	Po	At	Rn
Fr	Ra	Ac	Th	Pa	U	Np	Pu	Am	Cm	Bk	Cf	Es	Fm	Md	No	Lr	Rf	Db	Sg	Bh	Hs	Mt	Ds	Rg	Cn	Nh	Fl	Mc	Lv	Ts	Og

2: 1,1
8: 2,6
8: 2,6
18: 2,16
18: 2,16
32: 32 (center)
32: 32 (center)
-->
<?php

$table = array(
    array(1,1),
    array(2,6),
    array(2,6),
    array(2,16),
    array(2,16),
    array(2,15,15),
    array(2,15,15)
);

$curr = 1;
$chems = array('Hydrogen','Helium','Lithium','Beryllium','Boron','Carbon','Nitrogen','Oxygen','Fluorine','Neon','Sodium','Magnesium','Aluminum','Silicon','Phosphorus','Sulfur','Chlorine','Argon','Potassium','Calcium','Scandium','Titanium','Vanadium','Chromium','Manganese','Iron','Cobalt','Nickel','Copper','Zinc','Gallium','Germanium','Arsenic','Selenium','Bromine','Krypton','Rubidium','Strontium','Yttrium','Zirconium','Niobium','Molybdenum','Technetium','Ruthenium','Rhodium','Palladium','Silver','Cadmium','Indium','Tin','Antimony','Tellurium','Iodine','Xenon','Cesium','Barium','Lanthanum','Cerium','Praseodymium','Neodymium','Promethium','Samarium','Europium','Gadolinium','Terbium','Dysprosium','Holmium','Erbium','Thulium','Ytterbium','Lutetium','Hafnium','Tantalum','Tungsten','Rhenium','Osmium','Iridium','Platinum','Gold','Mercury','Thallium','Lead','Bismuth','Polonium','Astatine','Radon','Francium','Radium','Actinium','Thorium','Protactinium','Uranium','Neptunium','Plutonium','Americium','Curium','Berkelium','Californium','Einsteinium','Fermium','Mendelevium','Nobelium','Lawrencium','Rutherfordium','Dubnium','Seaborgium','Bohrium','Hassium','Meitnerium','Darmstadtium','Roentgenium','Copernicium','Nihonium','Flerovium','Moscovium','Livermorium','Tennessine','Oganesson');
function print_cell($id, $dir){
    global $chems;
    printf('<div title="%s" class="cell %s" style="--image: url(%d.JPG)"></div>', $chems[$id - 1], $dir, $id);
}

// echo '<div class="table-contain">';
echo '<div class="table">';
foreach($table as $row){
    echo '<div class="row">';
    switch(count($row)){
        case 3:
            list($left, $center, $right) = $row;
            foreach(range(1, $left) as $cell){ print_cell($curr++, "left"); }
            echo '<div class="f-block">';
            foreach(range(1, $center) as $cell){ print_cell($curr++, "center"); }
            echo '</div>';
            foreach(range(1, $right) as $cell){ print_cell($curr++, "right"); }
        break;
        case 2:
            list($left, $right) = $row;
            foreach(range(1, $left) as $cell){ print_cell($curr++, "left"); }
            echo '<div class="gap"></div>';
            foreach(range(1, $right) as $cell){ print_cell($curr++, "right"); }
    }
    echo '</div>';
}
echo '</div>';
// echo '</div>';
?>
<script>
    Array.from(document.querySelectorAll('.cell'), cell => {
        console.log(cell)
        cell.addEventListener('mouseenter', e => {
            document.body.setAttribute('style', e.target.getAttribute('style'))
        })
    })
</script>
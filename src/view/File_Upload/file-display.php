<?php
var_dump($this->params['imagePath']);
// yah ek idol method nahi hai params ko accsess karne ka becouse params per kishi bhi 
// prakar ka koi Abstaction nahi hai esko var_dump($this->foo);  banane ke lye __get() 
// magic method ka use hua hai View file me better undustanding ke liye dekhe---
echo "<br>";
var_dump($this->imagePath);
// var_dump($this->foo); esko yaha se var_dump($foo); tak lane ke liye View me render 
// method me foreach ki madat se params['foo'=>'bar'] foo jo ki kye hai usko variable banaya gaya hai
// bahau mast code hai samajhne vala.

echo "<br>";
var_dump($imagePath);
// know still working-----



// ---display photo--->
?>
<div style="border: 2px solid black; height: 400px; width: 400px;">
    <img src="<?= $imagePath ?>">
</div>';
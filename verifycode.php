<?php
// 使用了GD库 如若出现错误请安装GK库后重试

$number1 = rand(1, 99);
$number2 = rand(1, (99 - $number1));

$verifyCode = $number1 + $number2;

$image = imagecreatetruecolor(100, 50);

$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

// 填充背景
imagefilledrectangle($image, 0, 0, 200, 100, $white);

// 添加干扰因素
for ($i = 0; $i < 10; $i++) {
    imageline($image, rand(0, 100), rand(0, 50), rand(0, 100), rand(0, 50), $black);
}

$text = "$number1 + $number2 = ?";
imagestring($image, 5, 5, 5, $text, $black);

ob_start();
imagepng($image);
$contents = ob_get_clean();

imagedestroy($image);

$dataUri = "data:image/png;base64," . base64_encode($contents);

// 输出图像和验证码结果
echo $dataUri . "-" . $verifyCode; 
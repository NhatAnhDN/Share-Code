<?php
system("clear");
error_reporting(0);

// Màu Sắc
$nau= "\e[38;5;94m";
$lucnhat = "\033[1;96m";
$do = "\033[1;91m";
$xanh = "\033[1;92m";
$vang = "\033[1;93m";
$xanhd = "\033[1;94m";
$hong = "\033[1;95m";
$trang = "\033[1;97m";

// Logo
$logo = "$do           ===================================\n         $lucnhat |     Tool Termux Nuôi Facebook     |\n$do           ===================================\n\n";
echo "$logo";

// Kiểm tra file
if (!file_exists('cookienuoi.txt')){

// Nhập cookie
echo "$xanh =\> Nhập Cookie Facebook\n        $vang |> : ";
$cookie=trim(fgets(STDIN));

// Lưu cookie vào file
$k = fopen("cookienuoi.txt","a+");
fwrite($k, $cookie);
fclose($k);
}else{

// Đã nhập cookie trước đó
echo $trang."    Cookie Facebook :\n";
echo "$hong"."|•▪︎>$vang Bạn Đã Nhập Cookie Trước Đó Có Muốn Đổi ?\n$hong"."=\\>>$vang Nhập$do Y$vang or$do y$vang Để Đổi - Nhấn$xanh Enter Để Bỏ Qua : $hong";
$thay=trim(fgets(STDIN));
if($thay == "y" or $thay == "Y"){
system("rm cookienuoi.txt");
echo "\n$xanh =\> Nhập Cookie Facebook\n        $vang |> : ";
$cookie=trim(fgets(STDIN));
$k = fopen("cookienuoi.txt","a+");
fwrite($k, $cookie);
fclose($k);
}else{
$cookie = file_get_contents("cookienuoi.txt");
}}
echo "\n"."Đang Đăng Nhập ......\n";

// Header facebook
$headfb = array(
"Host: mbasic.facebook.com",
"upgrade-insecure-requests: 1",
"user-agent: Mozilla/5.0 (Linux; Android 7.1.1; CPH1729 Build/N6F26Q; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.198 YaBrowser/19.6.0.158 (lite) Mobile Safari/537.36",
"accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
"sec-fetch-site: same-origin",
"sec-fetch-mode: navigate",
"sec-fetch-user: ?1",
"sec-fetch-dest: document",
"accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
"cookie:$cookie",
);

// Header graph API
$headapi = array(
"Connection: keep-alive",
"authority: m.facebook.com",
"ccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
"accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
"sec-fetch-user: ?1",
"user-agent:Mozilla/5.0 (Linux; Android 10; SM-A015F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.134 Mobile Safari/537.36",
"cookie:$cookie",
);

// URL Lấy Token FB
$urltoken = "https://m.facebook.com/composer/ocelot/async_loader/?publisher=feed";

// Lấy Token FB
$access_token = gettoken($urltoken,$headapi);

// Kiểm Tra Live Cookie
if(strpos($access_token, 'EAAAA') !== 0){
echo "Cookie Die Rồi Hãy Nhập Lại !\n";
exit();
}

// Lấy ID FB
$idfb = json_decode(file_get_contents('https://graph.facebook.com/me/?access_token='.$access_token))->{'id'};

// Lấy Tên FB
$tenfb = json_decode(file_get_contents('https://graph.facebook.com/me/?access_token='.$access_token))-> {'name'};
system("clear");

echo "$logo";

// Mảng Chứa Nhiệm Vụ
$listnv = [];

// Mảng Chứa Cảm Xúc
$type = [];
echo $nau."
=========================================================\n";
echo "$vang"."[•] Cảm Xúc Auto\n\n";
echo "$xanh [1] •=> Cảm Xúc Like 👍\n";
echo "$do [2] •=> Cảm Xúc Love ❤\n";
echo "$trang [3] •=> Cảm Xúc Thương Thương 🥰\n";
echo "$hong [4] •=> Cảm Xúc HaHa 😆\n";
echo "$lucnhat [5] •=> Cảm Xúc WoW 😯\n";
echo "$nau [6] •=> Cảm Xúc Buồn 😭\n";
echo "$xanh [7] •=> Cảm Xúc Phẫn Nộ 😡\n";
echo "$trang"."=/\> Nhập Các Lựa Chọn : $xanh";
$camxuc = trim(fgets(STDIN));

/*
-Ktra Thêm Vào Mảng Nhiệm Vụ .
-Ở Đây Mình array_push 4 Lần Để Tăng Tỉ Lệ Chọn Trúng Job Bày Tỏ Cảm Xúc
*/

for($si=1;$si<=7;$si++){
if (strpos($camxuc,$si) !== false){
$checkpush = 1;
}}
if($checkpush == 1){
array_push($listnv,'REACTION');
array_push($listnv,'REACTION');
array_push($listnv,'REACTION');
array_push($listnv,'REACTION');
}

// Thêm Vào Mảng Cảm Xúc
if (strpos($camxuc, '1') !== false){
array_push($type,'LIKE');
}
if (strpos($camxuc, '2') !== false){
array_push($type,'LOVE');
}
if (strpos($camxuc, '3') !== false){
array_push($type,'LOVELY');
}
if (strpos($camxuc, '4') !== false){
array_push($type,'HAHA');
}
if (strpos($camxuc, '5') !== false){
array_push($type,'WOW');
}
if (strpos($camxuc, '6') !== false){
array_push($type,'SAD');
}
if (strpos($camxuc, '7') !== false){
array_push($type,'ANGRY');
}

// Lựa Chọn Chế Độ Cmt
echo $nau."\n=========================================================\n";
echo "$vang =>> Nhập [Y] Hoặc [y] Để Tool Auto Comment\n";
echo "$trang • Hoặc Nhấn Enter Để Bỏ Qua :$xanh "; 
$pickcmt=trim(fgets(STDIN));
if($pickcmt == "Y" or $pickcmt == "y"){
array_push($listnv,'CMT');
echo "\n$vang ! Nhập Nội Dung .... Hết Nhấn Enter 2 Lần\n\n";
$listmsg = [];
for($a=1;$a<=20;$a++){
echo "\n$xanh =\> Nhập Nội Dung CMT Thứ $a\n        $vang |> :$xanh ";
$msg=trim(fgets(STDIN));
if($msg == ""){
$msg = ".";
break;
}
array_push($listmsg,$msg);
}
}

// Lựa Chọn Chế Độ Kết Bạn
echo $nau."\n=========================================================\n";
echo "$vang =>> Nhập [Y] Hoặc [y] Để Tool Auto Kết Bạn\n";
echo "$trang • Hoặc Nhấn Enter Để Bỏ Qua :$xanh "; 
$pickadd = trim(fgets(STDIN));
if($pickadd == "Y" or $pickadd == "y"){
array_push($listnv,'ADDFRIEND');
}

// Nhập Delay
echo "\n$xanh =\> Nhập Time Delay 1\n        $vang |> : ";
$delaya=trim(fgets(STDIN));
if($delaya == ""){
$delaya =0;
}
echo "\n$xanh =\> Nhập Time Delay 2\n        $vang |> : ";
$delayb=trim(fgets(STDIN));
if($delayb == ""){
$delayb =0;
}

// Dừng Tool
echo "$vang"."Dừng Tool Sau Bao Nhiêu Tương Tác : $xanh";
$stop = trim(fgets(STDIN));
system("clear");

echo "$logo";
// Hiển thị info facebook
echo $trang."▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎\n";
echo "$do"."•$lucnhat"."AccCount$xanhd [$nau"."ID$trang".":$xanh$idfb$xanhd"."]$trang"."[$vang"."Name$trang".":$hong$tenfb$trang]\n";
echo $trang."▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎▪︎\n\n";
echo $xanh."========================================================\n";

// Vòng Lặp Kiểm Tra Live Cookie
while(true){
$access_token = gettoken($urltoken,$headapi);
if(strpos($access_token, 'EAAAA') !== 0){
echo "Cookie Die Rồi Hãy Nhập Lại !\n";
exit();
}

// Vòng Lặp Làm Nhiệm Vụ
while(true){
// Chọn Ngẫu Nhiên 1 Job
$setjob = array_rand($listnv);
$pickjob = $listnv[$setjob];

if($pickjob !== "ADDFRIEND"){
// URL Trang Chủ Facebook
$urlhome = "https://mbasic.facebook.com/";

// Lấy ID Bài Viết
$home = api($urlhome,$headfb);
$sidpost = explode('href="/photo.php?fbid=',$home);
$random = rand(1,5);
$idpost = explode('&amp',$sidpost[$random])[0];
}

// Job Auto Cảm Xúc
if($pickjob == "REACTION"){
// Chọn Ngẫu Nhiên 1 Cảm Xúc
$settype = array_rand($type);
$picktype = $type[$settype];

// URL Menu Cảm Xúc
$urlreac = "https://mbasic.facebook.com/reactions/picker/?is_permalink=1&ft_id=$idpost";

// Truy Cập Menu Cảm Xúc
$sreaction = api($urlreac,$headfb);

// Lọc Các Href (API Của Các Cảm Xúc)
$chose = explode('<a href="', $sreaction);
if($picktype == "LIKE"){
$clickreac = explode('" style="display:block"',$chose[1])[0];
}else if($picktype == "LOVE"){
$clickreac = explode('" style="display:block"', $chose[2])[0];
}else if($picktype == "LOVELY"){
$clickreac = explode('" style="display:block"',$chose[3])[0];
}else if($picktype == "HAHA"){
$clickreac = explode('" style="display:block"', $chose[4])[0];
}else if($picktype == "WOW"){
$clickreac = explode('" style="display:block"', $chose[5])[0];
}else if($picktype == "SAD"){
$clickreac = explode('" style="display:block"', $chose[6])[0];
}else if($picktype == "ANGRY"){
$clickreac = explode('" style="display:block"',$chose[7])[0];
}
$schose = html_entity_decode($clickreac);

// URL Thả Cảm Xúc
$urlclickreac = "https://mbasic.facebook.com$schose";

// Thả Cảm Xúc
$reaction = api($urlclickreac,$headfb);

// Loại Job
$typec = "$picktype";
}

// Job Comment
if($pickjob == "CMT"){
// Chọn Ngẫu Nhiên 1 Nội Dung
$setmsg = array_rand($listmsg);
$pickmsg = $listmsg[$setmsg];

// URL Bài Viết
$urlinfo = "https://mbasic.facebook.com/photo.php?fbid=$idpost&_rdr";

// Truy Cập Bài Viết
$scomment = api($urlinfo,$headfb);

// Lọc Dữ Liệu Định Danh Gửi Về Server
$sfb_dtsg = explode('<input type="hidden" name="fb_dtsg" value="',$scomment)[1];
$fb_dtsg = explode('" autocomplete="off" />',$sfb_dtsg)[0];
$sjazoest = explode('<input type="hidden" name="jazoest" value="',$scomment)[1];
$jazoest = explode('" autocomplete="off" />',$sjazoest)[0];

// Lọc Href (API Coomment)
$scodecmt = explode('action="/a/comment.php?',$scomment)[1];
$sscodecmt = explode('">',$scodecmt)[0];
$codecmt = html_entity_decode($sscodecmt);

// Data + Nội Dung Comment
$datacmt = "fb_dtsg=$fb_dtsg&jazoest=$jazoest&comment_text=$pickmsg";

// URL Gửi Comment
$urlcomment = "https://mbasic.facebook.com/a/comment.php?"."$codecmt";

// Gửi Comment
$comment = sapi($urlcomment,$datacmt,$headfb);

// Loại Job
$typec = "COMMENT";
}

// Job Thêm Bạn Bè
if($pickjob == "ADDFRIEND"){
// URL Danh Sách
$urllist = "https://mbasic.facebook.com/friends/center/mbasic/";

// Truy Cập List
$listadd = api($urllist,$headfb);
$scode = explode('<a href="/a/mobile/friends/add_friend.php?',$listadd)[1];
$sscode = explode('" class=',$scode)[0];
$codeadd = html_entity_decode($sscode);

$sid = explode('id=',$scode)[1];
$idpost = explode('&amp;',$sid)[0];

// URL Add Bạn Bè
$urladd = "https://mbasic.facebook.com/a/mobile/friends/add_friend.php?$codeadd";

// Gửi Lời Mời
$addfriend = api($urladd,$headfb);

// Loại Job
$typec = "ADD-FRIEND";
}

// Tăng Số Đếm
$dem ++;

// Delay
$delay = rand($delaya,$delayb);
$loadtime = delay($delay);

// Hoàn Thành
$done = xong($idpost,$typec,$dem);

// Stop
if($dem % $stop == 0){
exit();
}
}
}



// API Methods GET
function api($url,$header){
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => "$url",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_TIMEOUT => 30,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => $header
));
$ch2 = curl_exec($ch);
curl_close($ch);
return $ch2;
}

// API Methods POST
function sapi($url,$data,$header){
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => "$url",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_TIMEOUT => 30,
CURLOPT_POSTFIELDS => $data,
CURLOPT_HTTPHEADER => $header
));
$ch2 = curl_exec($ch);
curl_close($ch);
return $ch2;
}

// API Get Token Facebook
function gettoken($url,$header){
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => "$url",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_TIMEOUT => 30,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => $header
));
$ch2 = curl_exec($ch);
curl_close($ch);
$token = explode('\",\"useLocalFilePreview', explode('accessToken\":\"', $ch2)[1])[0];
return $token;
}

// Hiển thị nội dung
function xong($id,$type,$dem){
$lucnhat = "\033[1;96m";
$nau= "\e[38;5;94m";
$lucnhat = "\033[1;96m";
$do = "\033[1;91m";
$xanh = "\033[1;92m";
$vang = "\033[1;93m";
$xanhd = "\033[1;94m";
$hong = "\033[1;95m";
$trang = "\033[1;97m";

echo "$trang"."[$vang$dem$trang"."]$lucnhat =$trang [$hong$type$trang"."]$xanh <$do • •$xanh >$trang [$xanh"."ID:$id$trang"."]\n";
echo "$vang =>$trang [$vang"."Link$trang"."]$nau :$lucnhat m.facebook.com/$id\n";
echo $vang."=======================================================\n";
}

// Hiển thị delay
function delay($delay){
$nau= "\e[38;5;94m";
$lucnhat = "\033[1;96m";
$do = "\033[1;91m";
$xanh = "\033[1;92m";
$vang = "\033[1;93m";
$xanhd = "\033[1;94m";
$hong = "\033[1;95m";
$trang = "\033[1;97m";
for($time = $delay;$time > -1;$time--){
echo "\r$xanh==\>$nau"."[$trang"."Anh Hào Tool$nau"."]$do=>$xanh"."Vui$xanhd Lòng$do Chờ |●○○○○|$vang [$lucnhat$time$vang"."]   ";
usleep(270000);
echo "\r$xanh==\>$nau"."[$lucnhat"."Anh Hào Tool$nau"."]$do=>$hong"."Vui$trang Lòng$xanhd Chờ |○●○○○|$vang [$lucnhat$time$vang"."]   ";
usleep(370000);
echo "\r$xanh==\>$nau"."[$xanhd"."Anh Hào Tool$nau"."]$do=>$nau"."Vui$xanh Lòng$hong Chờ |○○●○○|$vang [$lucnhat$time$vang"."]   ";
usleep(270000);
echo "\r$xanh==\>$nau"."[$hong"."Anh Hào Tool$nau"."]$do=>$do"."Vui$lucnhat Lòng$vang Chờ |○○○●○|$vang [$lucnhat$time$vang"."]   ";
usleep(270000);
echo "\r$xanh==\>$nau"."[$xanh"."Anh Hào Tool$nau"."]$do=>$hong"."Vui$nau Lòng$nau Chờ |○○○○●|$vang [$lucnhat$time$vang"."]   ";
usleep(270000);
echo "\r                                            \r";
}}
?>
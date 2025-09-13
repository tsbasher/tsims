<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = array(
  array('id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Chattagram','bn_name' => 'চট্টগ্রাম','url' => 'www.chittagongdiv.gov.bd'),
  array('id' => '5a2a5e7d-d9d3-4db7-b639-b4441361424b','name' => 'Rajshahi','bn_name' => 'রাজশাহী','url' => 'www.rajshahidiv.gov.bd'),
  array('id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Khulna','bn_name' => 'খুলনা','url' => 'www.khulnadiv.gov.bd'),
  array('id' => 'd49ff831-5a12-4a5c-95cf-5c364817fced','name' => 'Barisal','bn_name' => 'বরিশাল','url' => 'www.barisaldiv.gov.bd'),
  array('id' => 'de4c80c8-24c8-46d8-bcd9-933698cd711f','name' => 'Sylhet','bn_name' => 'সিলেট','url' => 'www.sylhetdiv.gov.bd'),
  array('id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Dhaka','bn_name' => 'ঢাকা','url' => 'www.dhakadiv.gov.bd'),
  array('id' => '72e6aed8-c964-4cb1-a153-47dc82df864a','name' => 'Rangpur','bn_name' => 'রংপুর','url' => 'www.rangpurdiv.gov.bd'),
  array('id' => '205aef26-b92a-4627-bb60-dbbc2273e156','name' => 'Mymensingh','bn_name' => 'ময়মনসিংহ','url' => 'www.mymensinghdiv.gov.bd')
);



        $districts = array(
  array('id' => '1','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Comilla','bn_name' => 'কুমিল্লা','lat' => '23.4682747','lon' => '91.1788135','url' => 'www.comilla.gov.bd'),
  array('id' => '2','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Feni','bn_name' => 'ফেনী','lat' => '23.023231','lon' => '91.3840844','url' => 'www.feni.gov.bd'),
  array('id' => '3','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Brahmanbaria','bn_name' => 'ব্রাহ্মণবাড়িয়া','lat' => '23.9570904','lon' => '91.1119286','url' => 'www.brahmanbaria.gov.bd'),
  array('id' => '4','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Rangamati','bn_name' => 'রাঙ্গামাটি','lat' => '22.65561018','lon' => '92.17541121','url' => 'www.rangamati.gov.bd'),
  array('id' => '5','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Noakhali','bn_name' => 'নোয়াখালী','lat' => '22.869563','lon' => '91.099398','url' => 'www.noakhali.gov.bd'),
  array('id' => '6','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Chandpur','bn_name' => 'চাঁদপুর','lat' => '23.2332585','lon' => '90.6712912','url' => 'www.chandpur.gov.bd'),
  array('id' => '7','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Lakshmipur','bn_name' => 'লক্ষ্মীপুর','lat' => '22.942477','lon' => '90.841184','url' => 'www.lakshmipur.gov.bd'),
  array('id' => '8','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Chattogram','bn_name' => 'চট্টগ্রাম','lat' => '22.335109','lon' => '91.834073','url' => 'www.chittagong.gov.bd'),
  array('id' => '9','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Coxsbazar','bn_name' => 'কক্সবাজার','lat' => '21.44315751','lon' => '91.97381741','url' => 'www.coxsbazar.gov.bd'),
  array('id' => '10','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Khagrachhari','bn_name' => 'খাগড়াছড়ি','lat' => '23.119285','lon' => '91.984663','url' => 'www.khagrachhari.gov.bd'),
  array('id' => '11','division_id' => 'db16308a-f5b6-42e3-94fe-cff2026d30a4','name' => 'Bandarban','bn_name' => 'বান্দরবান','lat' => '22.1953275','lon' => '92.2183773','url' => 'www.bandarban.gov.bd'),
  array('id' => '12','division_id' => '5a2a5e7d-d9d3-4db7-b639-b4441361424b','name' => 'Sirajganj','bn_name' => 'সিরাজগঞ্জ','lat' => '24.4533978','lon' => '89.7006815','url' => 'www.sirajganj.gov.bd'),
  array('id' => '13','division_id' => '5a2a5e7d-d9d3-4db7-b639-b4441361424b','name' => 'Pabna','bn_name' => 'পাবনা','lat' => '23.998524','lon' => '89.233645','url' => 'www.pabna.gov.bd'),
  array('id' => '14','division_id' => '5a2a5e7d-d9d3-4db7-b639-b4441361424b','name' => 'Bogura','bn_name' => 'বগুড়া','lat' => '24.8465228','lon' => '89.377755','url' => 'www.bogra.gov.bd'),
  array('id' => '15','division_id' => '5a2a5e7d-d9d3-4db7-b639-b4441361424b','name' => 'Rajshahi','bn_name' => 'রাজশাহী','lat' => '24.37230298','lon' => '88.56307623','url' => 'www.rajshahi.gov.bd'),
  array('id' => '16','division_id' => '5a2a5e7d-d9d3-4db7-b639-b4441361424b','name' => 'Natore','bn_name' => 'নাটোর','lat' => '24.420556','lon' => '89.000282','url' => 'www.natore.gov.bd'),
  array('id' => '17','division_id' => '5a2a5e7d-d9d3-4db7-b639-b4441361424b','name' => 'Joypurhat','bn_name' => 'জয়পুরহাট','lat' => '25.09636876','lon' => '89.04004280','url' => 'www.joypurhat.gov.bd'),
  array('id' => '18','division_id' => '5a2a5e7d-d9d3-4db7-b639-b4441361424b','name' => 'Chapainawabganj','bn_name' => 'চাঁপাইনবাবগঞ্জ','lat' => '24.5965034','lon' => '88.2775122','url' => 'www.chapainawabganj.gov.bd'),
  array('id' => '19','division_id' => '5a2a5e7d-d9d3-4db7-b639-b4441361424b','name' => 'Naogaon','bn_name' => 'নওগাঁ','lat' => '24.83256191','lon' => '88.92485205','url' => 'www.naogaon.gov.bd'),
  array('id' => '20','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Jashore','bn_name' => 'যশোর','lat' => '23.16643','lon' => '89.2081126','url' => 'www.jessore.gov.bd'),
  array('id' => '21','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Satkhira','bn_name' => 'সাতক্ষীরা','lat' => '22.7180905','lon' => '89.0687033','url' => 'www.satkhira.gov.bd'),
  array('id' => '22','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Meherpur','bn_name' => 'মেহেরপুর','lat' => '23.762213','lon' => '88.631821','url' => 'www.meherpur.gov.bd'),
  array('id' => '23','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Narail','bn_name' => 'নড়াইল','lat' => '23.172534','lon' => '89.512672','url' => 'www.narail.gov.bd'),
  array('id' => '24','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Chuadanga','bn_name' => 'চুয়াডাঙ্গা','lat' => '23.6401961','lon' => '88.841841','url' => 'www.chuadanga.gov.bd'),
  array('id' => '25','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Kushtia','bn_name' => 'কুষ্টিয়া','lat' => '23.901258','lon' => '89.120482','url' => 'www.kushtia.gov.bd'),
  array('id' => '26','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Magura','bn_name' => 'মাগুরা','lat' => '23.487337','lon' => '89.419956','url' => 'www.magura.gov.bd'),
  array('id' => '27','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Khulna','bn_name' => 'খুলনা','lat' => '22.815774','lon' => '89.568679','url' => 'www.khulna.gov.bd'),
  array('id' => '28','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Bagerhat','bn_name' => 'বাগেরহাট','lat' => '22.651568','lon' => '89.785938','url' => 'www.bagerhat.gov.bd'),
  array('id' => '29','division_id' => '5b80bd7e-530b-4599-a58f-09a190ca1637','name' => 'Jhenaidah','bn_name' => 'ঝিনাইদহ','lat' => '23.5448176','lon' => '89.1539213','url' => 'www.jhenaidah.gov.bd'),
  array('id' => '30','division_id' => 'd49ff831-5a12-4a5c-95cf-5c364817fced','name' => 'Jhalakathi','bn_name' => 'ঝালকাঠি','lat' => '22.6422689','lon' => '90.2003932','url' => 'www.jhalakathi.gov.bd'),
  array('id' => '31','division_id' => 'd49ff831-5a12-4a5c-95cf-5c364817fced','name' => 'Patuakhali','bn_name' => 'পটুয়াখালী','lat' => '22.3596316','lon' => '90.3298712','url' => 'www.patuakhali.gov.bd'),
  array('id' => '32','division_id' => 'd49ff831-5a12-4a5c-95cf-5c364817fced','name' => 'Pirojpur','bn_name' => 'পিরোজপুর','lat' => '22.5781398','lon' => '89.9983909','url' => 'www.pirojpur.gov.bd'),
  array('id' => '33','division_id' => 'd49ff831-5a12-4a5c-95cf-5c364817fced','name' => 'Barisal','bn_name' => 'বরিশাল','lat' => '22.7004179','lon' => '90.3731568','url' => 'www.barisal.gov.bd'),
  array('id' => '34','division_id' => 'd49ff831-5a12-4a5c-95cf-5c364817fced','name' => 'Bhola','bn_name' => 'ভোলা','lat' => '22.685923','lon' => '90.648179','url' => 'www.bhola.gov.bd'),
  array('id' => '35','division_id' => 'd49ff831-5a12-4a5c-95cf-5c364817fced','name' => 'Barguna','bn_name' => 'বরগুনা','lat' => '22.159182','lon' => '90.125581','url' => 'www.barguna.gov.bd'),
  array('id' => '36','division_id' => 'de4c80c8-24c8-46d8-bcd9-933698cd711f','name' => 'Sylhet','bn_name' => 'সিলেট','lat' => '24.8897956','lon' => '91.8697894','url' => 'www.sylhet.gov.bd'),
  array('id' => '37','division_id' => 'de4c80c8-24c8-46d8-bcd9-933698cd711f','name' => 'Moulvibazar','bn_name' => 'মৌলভীবাজার','lat' => '24.482934','lon' => '91.777417','url' => 'www.moulvibazar.gov.bd'),
  array('id' => '38','division_id' => 'de4c80c8-24c8-46d8-bcd9-933698cd711f','name' => 'Habiganj','bn_name' => 'হবিগঞ্জ','lat' => '24.374945','lon' => '91.41553','url' => 'www.habiganj.gov.bd'),
  array('id' => '39','division_id' => 'de4c80c8-24c8-46d8-bcd9-933698cd711f','name' => 'Sunamganj','bn_name' => 'সুনামগঞ্জ','lat' => '25.0658042','lon' => '91.3950115','url' => 'www.sunamganj.gov.bd'),
  array('id' => '40','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Narsingdi','bn_name' => 'নরসিংদী','lat' => '23.932233','lon' => '90.71541','url' => 'www.narsingdi.gov.bd'),
  array('id' => '41','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Gazipur','bn_name' => 'গাজীপুর','lat' => '24.0022858','lon' => '90.4264283','url' => 'www.gazipur.gov.bd'),
  array('id' => '42','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Shariatpur','bn_name' => 'শরীয়তপুর','lat' => '23.2060195','lon' => '90.3477725','url' => 'www.shariatpur.gov.bd'),
  array('id' => '43','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Narayanganj','bn_name' => 'নারায়ণগঞ্জ','lat' => '23.63366','lon' => '90.496482','url' => 'www.narayanganj.gov.bd'),
  array('id' => '44','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Tangail','bn_name' => 'টাঙ্গাইল','lat' => '24.264145','lon' => '89.918029','url' => 'www.tangail.gov.bd'),
  array('id' => '45','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Kishoreganj','bn_name' => 'কিশোরগঞ্জ','lat' => '24.444937','lon' => '90.776575','url' => 'www.kishoreganj.gov.bd'),
  array('id' => '46','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Manikganj','bn_name' => 'মানিকগঞ্জ','lat' => '23.8602262','lon' => "90.0018293",'url' => 'www.manikganj.gov.bd'),
  array('id' => '47','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Dhaka','bn_name' => 'ঢাকা','lat' => '23.7115253','lon' => '90.4111451','url' => 'www.dhaka.gov.bd'),
  array('id' => '48','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Munshiganj','bn_name' => 'মুন্সিগঞ্জ','lat' => '23.5435742','lon' => '90.5354327','url' => 'www.munshiganj.gov.bd'),
  array('id' => '49','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Rajbari','bn_name' => 'রাজবাড়ী','lat' => '23.7574305','lon' => '89.6444665','url' => 'www.rajbari.gov.bd'),
  array('id' => '50','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Madaripur','bn_name' => 'মাদারীপুর','lat' => '23.164102','lon' => '90.1896805','url' => 'www.madaripur.gov.bd'),
  array('id' => '51','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Gopalganj','bn_name' => 'গোপালগঞ্জ','lat' => '23.0050857','lon' => '89.8266059','url' => 'www.gopalganj.gov.bd'),
  array('id' => '52','division_id' => '7ef39cd1-1565-4fae-8291-58e5c7873a24','name' => 'Faridpur','bn_name' => 'ফরিদপুর','lat' => '23.6070822','lon' => '89.8429406','url' => 'www.faridpur.gov.bd'),
  array('id' => '53','division_id' => '72e6aed8-c964-4cb1-a153-47dc82df864a','name' => 'Panchagarh','bn_name' => 'পঞ্চগড়','lat' => '26.3411','lon' => '88.5541606','url' => 'www.panchagarh.gov.bd'),
  array('id' => '54','division_id' => '72e6aed8-c964-4cb1-a153-47dc82df864a','name' => 'Dinajpur','bn_name' => 'দিনাজপুর','lat' => '25.6217061','lon' => '88.6354504','url' => 'www.dinajpur.gov.bd'),
  array('id' => '55','division_id' => '72e6aed8-c964-4cb1-a153-47dc82df864a','name' => 'Lalmonirhat','bn_name' => 'লালমনিরহাট','lat' => '25.9165451','lon' => '89.4532409','url' => 'www.lalmonirhat.gov.bd'),
  array('id' => '56','division_id' => '72e6aed8-c964-4cb1-a153-47dc82df864a','name' => 'Nilphamari','bn_name' => 'নীলফামারী','lat' => '25.931794','lon' => '88.856006','url' => 'www.nilphamari.gov.bd'),
  array('id' => '57','division_id' => '72e6aed8-c964-4cb1-a153-47dc82df864a','name' => 'Gaibandha','bn_name' => 'গাইবান্ধা','lat' => '25.328751','lon' => '89.528088','url' => 'www.gaibandha.gov.bd'),
  array('id' => '58','division_id' => '72e6aed8-c964-4cb1-a153-47dc82df864a','name' => 'Thakurgaon','bn_name' => 'ঠাকুরগাঁও','lat' => '26.0336945','lon' => '88.4616834','url' => 'www.thakurgaon.gov.bd'),
  array('id' => '59','division_id' => '72e6aed8-c964-4cb1-a153-47dc82df864a','name' => 'Rangpur','bn_name' => 'রংপুর','lat' => '25.7558096','lon' => '89.244462','url' => 'www.rangpur.gov.bd'),
  array('id' => '60','division_id' => '72e6aed8-c964-4cb1-a153-47dc82df864a','name' => 'Kurigram','bn_name' => 'কুড়িগ্রাম','lat' => '25.805445','lon' => '89.636174','url' => 'www.kurigram.gov.bd'),
  array('id' => '61','division_id' => '205aef26-b92a-4627-bb60-dbbc2273e156','name' => 'Sherpur','bn_name' => 'শেরপুর','lat' => '25.0204933','lon' => '90.0152966','url' => 'www.sherpur.gov.bd'),
  array('id' => '62','division_id' => '205aef26-b92a-4627-bb60-dbbc2273e156','name' => 'Mymensingh','bn_name' => 'ময়মনসিংহ','lat' => '24.7465670','lon' => '90.4072093','url' => 'www.mymensingh.gov.bd'),
  array('id' => '63','division_id' => '205aef26-b92a-4627-bb60-dbbc2273e156','name' => 'Jamalpur','bn_name' => 'জামালপুর','lat' => '24.937533','lon' => '89.937775','url' => 'www.jamalpur.gov.bd'),
  array('id' => '64','division_id' => '205aef26-b92a-4627-bb60-dbbc2273e156','name' => 'Netrokona','bn_name' => 'নেত্রকোণা','lat' => '24.870955','lon' => '90.727887','url' => 'www.netrokona.gov.bd')
);
        
    }
}

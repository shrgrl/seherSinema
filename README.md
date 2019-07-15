# seherSinema
PHP programlama dili ve mySql sorgu dili olarak seçtiğimiz Sinema Otamasyonu projemizde Kullanıcı Girişi ve Yönetici Girişi olarak iki adet giriş ekranımız bulunmaktadır. Çalışmamızda Bootstrap da kullanılmıştır.<br>
Veritabanı olarak mySql kullandığımız projemizde 13 adet tablomuz bulunmaktadır. Aşağıda tablolarımızı görüyorsunuz:

![](https://github.com/shrgrl/seherSinema/blob/master/img/img1.jpg)

## Projenin Çalıştırılması
Projeyi çalıştırmak için ilk önce bilgisayarımızda yüklü bulunan XAMPP programını açıp, <i>Apache</i> ve <i>MySQL</i> seçeneklerini <strong>Start</strong> etmemiz gerekiyor.<br>
![](https://github.com/shrgrl/PHPHospitalManagementSystem/blob/master/images/img1.JPG)
<br>Ardından web tarayıcımıza <strong>localhost</strong> yazıyoruz.
![](https://github.com/shrgrl/PHPHospitalManagementSystem/blob/master/images/img2.JPG)
<br>Önceden veritabanına eklemiş olduğumuz projemizi seçiyoruz.
![](https://github.com/shrgrl/PHPHospitalManagementSystem/blob/master/images/img3.JPG)
<br>Son olarak src seçeneği, tıkladığımızda bizi ana sayfaya yönlendirecektir.

<br>Projemizin ilk sayfasında giriş ekranı bulunmaktadır. Kullanıcı Girişi veya Yönetici Girişi olarak giriş yapabiliriz. Aşağıda Kullanıcı ve Yönetici Girişi olarak uygulayabileceğimiz adımları aşağıda sıralanmıştır.
## Kullanıcı İşlemleri
Burada kullanıcı kayıtlı ise bilgilerini girerek sisteme giriş yapabilmektedir. Eğer kayıtlı değilse kayıt ol butonu ile kayıt yapabilmektedir.

![](https://github.com/shrgrl/seherSinema/blob/master/img/img2.jpg)

<br>Kullanıcının yeni kayıt yapması için kullanılan sayfamız bu şekilde görünmektedir. Verilen bilgileri doğru bir şekilde tamamlayıp kayıt ol butonuna basarak kayıt işlemini tamamlar. Daha sonra yukarıda “Kayıt işlemi başarılı” ya da “Kayıt işlemi başarısız” tarzında uyarılar vermektedir. Başarısız kayıt nedenleri eksik bilgiler ya da halıhazırda mevcut bir hesap ile kayıt yapılmak istenmesi olabilir:

![](https://github.com/shrgrl/seherSinema/blob/master/img/img3.jpg)

<br>Kayıtlı kullanıcının tekrar kayıt isteği üzerine verilen uyarı örnekteki gibidir:

![](https://github.com/shrgrl/seherSinema/blob/master/img/img4.jpg)

<br>Kayıt yaptıktan sonra artık sisteme giriş yapabiliriz. İstenilen bilgileri girdikten sonra giriş yap diyerek sistemimize giriş yapıyoruz:

![](https://github.com/shrgrl/seherSinema/blob/master/img/img5.jpg)

<br>Kullanıcı girişi ardından karşılaşacağımız sayfamız bu şekilde görünmektedir. Kullanıcı “Sinema, Film ve Tarih” seçeneklerinden dilediğini seçerek arama yapabilir veya sunulmuş mevcut arayüz ile seçimlerini gerçekleştirebilir.

![](https://github.com/shrgrl/seherSinema/blob/master/img/img6.jpg)

<br>Kullanıcının “Hokkabaz” filmini seçtiğini varsayalım. Resimde de görüldüğü gibi filmin müsait koltuk sayılarını göstererek bir yönlendirme yapıyor.

![](https://github.com/shrgrl/seherSinema/blob/master/img/img7.jpg)

<br>Müsait koltuklar var ise tekrar tıklıyoruz ve istediğimiz koltuk numaralarını seçerek satın alma işlemi gerçekleştiriyoruz. Kırmızı renkli koltuklar dolu, beyaz renkli koltuklar boş ve yeşil renkte görünen de bizim seçim yaptığımız koltuk. Satın alma işleminin ardından yeşil renk kırmızı olacak.

![](https://github.com/shrgrl/seherSinema/blob/master/img/img8.jpg)

## Yönetici İşlemleri
Yönetici giriş ekranımız da müşteri giriş ekranı ile aynı özelliklere sahiptir. İstenen bilgileri girerek yönetici sayfamıza giriş yapabiliriz.

![](https://github.com/shrgrl/seherSinema/blob/master/img/img9.jpg)

<br>Yönetici sayfası bize filmlerin seansları, gösterimleri, bilet işlemleri vs. hakkında bilgilerini girmemize olanak sağlıyor.

![](https://github.com/shrgrl/seherSinema/blob/master/img/img10.jpg)

<br>“Sinema&Salon” sekmesine tıkladığımızda girebileceğimiz ve görebileceğimiz bilgiler:

![](https://github.com/shrgrl/seherSinema/blob/master/img/img11.jpg)

<br>“Seans” sekmesine tıkladığımızda girebileceğimiz ve görebileceğimiz bilgiler:

![](https://github.com/shrgrl/seherSinema/blob/master/img/img12.jpg)

<br>“Film” sekmesine tıkladığımızda girebileceğimiz ve görebileceğimiz bilgiler:

![](https://github.com/shrgrl/seherSinema/blob/master/img/img13.jpg)

<br>“Gösterim&Bilet” sekmesine tıkladığımızda girebileceğimiz ve görebileceğimiz bilgiler:

![](https://github.com/shrgrl/seherSinema/blob/master/img/img14.jpg)

<br>“Satış” sekmesine tıkladığımızda görebileceğimiz bilgiler :

![](https://github.com/shrgrl/seherSinema/blob/master/img/img15.jpg)

![](https://github.com/shrgrl/seherSinema/blob/master/img/img16.jpg)

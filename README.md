# seherSinema
PHP programlama dili ve mySql sorgu dili olarak seçtiğimiz Sinema Otamasyonu projemizde Kullanıcı Girişi ve Yönetici Girişi olarak iki adet giriş ekranımız bulunmaktadır. Çalışmamızda Bootstrap da kullanılmıştır.<br>
Veritabanı olarak mySql kullandığımız projemizde 13 adet tablomuz bulunmaktadır. Aşağıda tablolarımızı görüyorsunuz:
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img1.jpg />
Projemizin ilk sayfasında giriş ekranı bulunmaktadır. Kullanıcı Girişi veya Yönetici Girişi olarak giriş yapabiliriz. Aşağıda Kullanıcı ve Yönetici Girişi olarak uygulayabileceğimiz adımları aşağıda sıralanmıştır.
## Kullanıcı İşlemleri
Burada kullanıcı kayıtlı ise bilgilerini girerek sisteme giriş yapabilmektedir. Eğer kayıtlı değilse kayıt ol butonu ile kayıt yapabilmektedir.
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img2.jpg />
Kullanıcının yeni kayıt yapması için kullanılan sayfamız bu şekilde görünmektedir. Verilen bilgileri doğru bir şekilde tamamlayıp kayıt ol butonuna basarak kayıt işlemini tamamlar. Daha sonra yukarıda “Kayıt işlemi başarılı” ya da “Kayıt işlemi başarısız” tarzında uyarılar vermektedir. Başarısız kayıt nedenleri eksik bilgiler ya da halıhazırda mevcut bir hesap ile kayıt yapılmak istenmesi olabilir:
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img3.jpg />
Kayıtlı kullanıcının tekrar kayıt isteği üzerine verilen uyarı örnekteki gibidir:
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img4.jpg />
Kayıt yaptıktan sonra artık sisteme giriş yapabiliriz. İstenilen bilgileri girdikten sonra giriş yap diyerek sistemimize giriş yapıyoruz:
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img5.jpg />
Kullanıcı girişi ardından karşılaşacağımız sayfamız bu şekilde görünmektedir. Kullanıcı “Sinema, Film ve Tarih” seçeneklerinden dilediğini seçerek arama yapabilir veya sunulmuş mevcut arayüz ile seçimlerini gerçekleştirebilir.
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img6.jpg />
Kullanıcının “Hokkabaz” filmini seçtiğini varsayalım. Resimde de görüldüğü gibi filmin müsait koltuk sayılarını göstererek bir yönlendirme yapıyor.
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img7.jpg />
Müsait koltuklar var ise tekrar tıklıyoruz ve istediğimiz koltuk numaralarını seçerek satın alma işlemi gerçekleştiriyoruz. Kırmızı renkli koltuklar dolu, beyaz renkli koltuklar boş ve yeşil renkte görünen de bizim seçim yaptığımız koltuk. Satın alma işleminin ardından yeşil renk kırmızı olacak.
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img8.jpg />
## Yönetici İşlemleri
Yönetici giriş ekranımız da müşteri giriş ekranı ile aynı özelliklere sahiptir. İstenen bilgileri girerek yönetici sayfamıza giriş yapabiliriz.
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img9.jpg />
Yönetici sayfası bize filmlerin seansları, gösterimleri, bilet işlemleri vs. hakkında bilgilerini girmemize olanak sağlıyor.
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img10.jpg />
“Sinema&Salon” sekmesine tıkladığımızda girebileceğimiz ve görebileceğimiz bilgiler:
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img11.jpg />
“Seans” sekmesine tıkladığımızda girebileceğimiz ve görebileceğimiz bilgiler:
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img12.jpg />
“Film” sekmesine tıkladığımızda girebileceğimiz ve görebileceğimiz bilgiler:
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img13.jpg />
“Gösterim&Bilet” sekmesine tıkladığımızda girebileceğimiz ve görebileceğimiz bilgiler:
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img14.jpg />
“Satış” sekmesine tıkladığımızda görebileceğimiz bilgiler :
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img15.jpg />
<br><img src=https://github.com/shrgrl/PHPHospitalManagementSystem/tree/master/images/img16.jpg />

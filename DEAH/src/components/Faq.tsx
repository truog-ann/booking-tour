import Header from './Header'
import Footer from './Footer'

const Faq = () => {
  return (
    <div>
      <div>
       <Header status={true}/>
        <main>
          {/* Breadcrumbs S t a r t */}
          <section className="breadcrumbs-area breadcrumb-bg">
            <div className="container">
              <h1 className="title wow fadeInUp" data-wow-delay="0.0s">câu Hỏi Thường Gặp</h1>
              <div className="breadcrumb-text">
                <nav aria-label="breadcrumb" className="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                  <ul className="breadcrumb listing">
                    <li className="breadcrumb-item single-list"><a href="index" className="single">Trang chủ</a></li>
                    <li className="breadcrumb-item single-list" aria-current="page"><a href="javascript:void(0)" className="single active">câuHỏiThườngGặp</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </section>
          {/*/ End-of Breadcrumbs*/}
          {/* Any Question Area S t a r t */}
          <section className="question-area section-padding">
            <div className="container">
              <div className="row align-items-center">
                <div className="col-lg-8">
                  {/* Section Tittle */}
                  <div className="section-tittle mb-50">
                    <h2 className="title font-700"> Mọi câu hỏi </h2>
                    <p className="pera"> Khi quyết định quyên góp cho tổ chức từ thiện nào, điều quan trọng là phải thực hiện tìm kiếm của bạn
                      và tìm một
                      phù hợp với các giá trị và sở thích của bạn. </p>
                  </div>
                  <div className="accordion" id="accordionExample">
                    {/* Single */}
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingOne">
                        <button className="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Have you weighed the potential risks and
                          benefits?</button>
                      </h2>
                      <div id="collapseOne" className="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div className="accordion-body">Khi quyết định quyên góp cho tổ chức từ thiện nào, điều đó rất quan trọng
                          để làm của bạn
                          Tìm kiếm. </div>
                      </div>
                    </div>
                    {/* Single */}
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingTwo">
                        <button className="accordion-button collapsed additional-styles" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How will you gather
                          Phản hồi từ các bên liên quan </button>
                      </h2>
                      <div id="collapseTwo" className="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div className="accordion-body">Khi quyết định quyên góp cho tổ chức từ thiện nào, điều đó rất quan trọng
                          để làm của bạn
                          tìm kiếm.</div>
                      </div>
                    </div>
                    {/* Single */}
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingThree">
                        <button className="accordion-button collapsed additional-styles" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">There any
                          Tính bền vững hoặc đạo đức để tính đến?</button>
                      </h2>
                      <div id="collapseThree" className="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div className="accordion-body">Khi quyết định quyên góp cho tổ chức từ thiện nào, điều đó rất quan trọng
                          để làm của bạn
                          tìm kiếm.</div>
                      </div>
                    </div>
                    {/* Single */}
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingFour">
                        <button className="accordion-button collapsed additional-styles" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">There any
                          Tính bền vững hoặc đạo đức để tính đến?</button>
                      </h2>
                      <div id="collapseFour" className="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div className="accordion-body">Khi quyết định quyên góp cho tổ chức từ thiện nào, điều đó rất quan trọng
                          để làm của bạn
                          tìm kiếm.</div>
                      </div>
                    </div>
                    {/* Single */}
                    <div className="accordion-item">
                      <h2 className="accordion-header" id="headingFive">
                        <button className="accordion-button collapsed additional-styles" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">There any
                          Lorem rất thông minh Nibh Dinh dưỡng</button>
                      </h2>
                      <div id="collapseFive" className="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div className="accordion-body">Khi quyết định quyên góp cho tổ chức từ thiện nào, điều đó rất quan trọng
                          để làm của bạn
                          tìm kiếm.</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-xl-4 col-lg-5">
                  <img className="w-100 d-none d-lg-block tilt-effect radius-10" src="/src/assets/images/gallery/faq.jpg" alt="image" />
                </div>
              </div>
            </div>
          </section>
          {/*/ End-of Question Area */}
          {/* FAQs S t r t */}
          <div className="faqs-area bottom-padding">
            <div className="container">
              <div className="row">
                <div className="col-xl-12">
                  {/* Single */}
                  <div className="single-terms mb-30">
                    <h5 className="title font-600">Cà rốt tăng cường</h5>
                    <p className="pera mb-20">Lorem anh ấy C. rốt tăng cường.Nibh Dinh dưỡng hoặc chưa
                      Bóng đá Malesuada
                      cư dân carton hoặc.Nếu ID tác giả lâm sàng không có sinh viên sư tử nào của bóng đá.Hơn chất chống oxy hóa
                      cũ, đường kính của tôi.
                      Yếu tố hiệu suất chuối tại môi trường.Vui lòng kiểm tra các nhà phát triển của nhà phát triển Protein vào ngày mai
                      chế tạo.Chính nó
                      Trang trí của </ p>
                    {/* Single Listing */}
                    <ul className="experience listing listing2">
                      <li className="single-list">
                        <i className="ri-shield-check-line" />
                        <p className="pera">Bắt buộc tăng cường.Dinh dưỡng NIBH</p>
                      </li>
                      <li className="single-list">
                        <i className="ri-shield-check-line" />
                        <p className="pera">Cà rốt tăng cường.Dinh dưỡng NIBH</p>
                      </li>
                      <li className="single-list">
                        <i className="ri-shield-check-line" />
                        <p className="pera">Dinh dưỡng NIBH</p>
                      </li>
                      <li className="single-list">
                        <i className="ri-shield-check-line" />
                        <p className="pera">Lorem rất thông minh Nibh Dinh dưỡng</p>
                      </li>
                      <li className="single-list">
                        <i className="ri-shield-check-line" />
                        <p className="pera">ipsum Cà rốt tăng cường. Nibh pellentesque</p>
                      </li>
                    </ul>
                  </div>
                  {/* Single */}
                  <div className="single-terms mb-30">
                    <h5 className="title font-600">Lorem rất thông minh</h5>
                    <p className="pera mb-20">Lorem anh ấy C. rốt tăng cường.Nibh Dinh dưỡng hoặc chưa
                      Bóng đá Malesuada
                      cư dân carton hoặc.Nếu ID tác giả lâm sàng không có sinh viên sư tử nào của bóng đá.Hơn chất chống oxy hóa
                      cũ, đường kính của tôi.
                      Yếu tố hiệu suất chuối tại môi trường.Vui lòng kiểm tra các nhà phát triển của nhà phát triển Protein vào ngày mai
                      chế tạo.Chính nó
                      Bóng đá khấu trừ tại lâm sàng hoặc xấu xí.Nhà phát triển Mũi tên Mass là nụ cười sô cô la hoặc
                      URN.Men
                      Truyền hình xấu xí nhưng trẻ em có một nụ cười cho trẻ em.Cảnh sát chính thống run rẩy
                      Massa </ p>
                    <p className="pera mb-20"> Arcu et Justo Quis Aennean Sed.Sollicitudin Eget Mus Semper Vitae Nibh
                      Eget Toror
                      hàng hóa.Cursus vel Scleerisque UT tại.Lacus Orci Vel Dolor Eget Velit Aliquet.Nhân Mã
                      Laoreet non Sed
                      Mattis Trisque A ut.Volutpat hậu quả.</p>
                  </div>
                  {/* Single */}
                  <div className="single-terms mb-0">
                    <h5 className="title font-600">Nhìn nhận</h5>
                    <p className="pera mb-20"> Bằng cách sử dụng dịch vụ hoặc các dịch vụ khác do chúng tôi cung cấp, bạn thừa nhận
                      Mà bạn có
                      Đọc các Điều khoản dịch vụ này và đồng ý bị ràng buộc bởi họ.</p>
                  </div>
                  {/* Single */}
                  <div className="single-terms mb-0">
                    <h5 className="title font-600">Liên hệ Us</h5>
                    <p className="pera mb-20 text-normal">Email: <a href="#">initTheme@gmail.com</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {/*/ End-of FAQs*/}
        </main>
        {/* Footer S t a r t */}
      <Footer/>
        <div className="progressParent" id="back-top">
          <svg className="backCircle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
          </svg>
        </div>
        <div className="search-overlay" />
      </div>

    </div>
  )
}

export default Faq

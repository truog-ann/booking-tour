
import Header from './Header'
import Footer from './Footer'

const Verification = () => {
  return (
    <div>
      <div>
  <Header status={true}/>
        <main>
          {/* Breadcrumbs S t a r t */}
          <section className="breadcrumbs-area breadcrumb-bg">
            <div className="container">
              <h1 className="title wow fadeInUp" data-wow-delay="0.0s">xác minh</h1>
              <div className="breadcrumb-text">
                <nav aria-label="breadcrumb" className="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                  <ul className="breadcrumb listing">
                    <li className="breadcrumb-item single-list"><a href="index" className="single">Trang chủ</a></li>
                    <li className="breadcrumb-item single-list" aria-current="page"><a href="javascript:void(0)" className="single active">Verification</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </section>
          {/*/ End-of Breadcrumbs*/}
          {/* Login area S t a r t  */}
          <div className="login-area section-padding">
            <div className="container">
              <div className="row justify-content-center">
                <div className="col-xl-5 col-lg-6 col-md-8 col-sm-10">
                  <div className="login-card">
                    {/* Logo */}
                    <div className="logo mb-40">
                      <a href="index" className="mb-30 d-block">
                        <img src="/src/assets/images/logo/logo.png" alt="logo" className="changeLogo" />
                      </a>
                    </div>
                    {/* Form */}
                    <form action="#" method="POST">
                      <div className="contact-form">
                        <label className="contact-label">Email </label>
                      </div>
                      <div className="row">
                        <div className="col-lg-3">
                          <div className="contact-form mb-24">
                            <input className="form-control contact-input text-center" type="text" placeholder="{5}" />

                          </div>
                        </div>
                        <div className="col-lg-3">
                          <div className="contact-form mb-24">
                            <input className="form-control contact-input text-center" type="text" placeholder="{0}" />

                          </div>
                        </div>
                        <div className="col-lg-3">
                          <div className="contact-form mb-24">
                            <input className="form-control contact-input text-center" type="text" placeholder="{3}" />

                          </div>
                        </div>
                        <div className="col-lg-3">
                          <div className="contact-form mb-24">
                            <input className="form-control contact-input text-center" type="text" placeholder="{1}" />

                          </div>
                        </div>
                      </div>
                      <a href="new-password" className="btn-primary-fill justify-content-center w-100">
                        <span className="d-flex justify-content-center gap-6">
                          <i className="ri-lock-line" />
                          <span>Verify</span>
                        </span>
                      </a>
                    </form>
                    <div className="login-footer">
                      <div className="create-account">
                        <p className="mb-0">
                          Quay trở lại
                          <a href="login">
                            <span className="text-primary">Đăng nhập</span>
                          </a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {/*/ End-of Login */}
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

export default Verification

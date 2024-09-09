import Header from './Header';
import Footer from './Footer';
import axios from 'axios';
import { toast } from 'react-toastify';
import { useForm } from 'react-hook-form';

const Forgot = () => {
  const { register, handleSubmit, reset } = useForm();

  const onSubmit = async (data:any) => {
    try {
      await axios.post(`${import.meta.env.VITE_BACKEND_URL}/api/client/mail-forget-pass`, {
        email: data.email,
      });
      toast.success('Bạn đã cập nhật thông tin thành công'); 
      reset();
    } catch (error) {
      console.error('Error updating information:', error);
      toast.error('Cập nhật thất bại');
    }
  };

  return ( 
    <div>
      <Header status={undefined} />
      <main>
        <section className="breadcrumbs-area breadcrumb-bg">
          <div className="container">
            <h1 className="title wow fadeInUp" data-wow-delay="0.0s">Quên mật khẩu</h1>
            <div className="breadcrumb-text">
              <nav aria-label="breadcrumb" className="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                <ul className="breadcrumb listing">
                  <li className="breadcrumb-item single-list"><a href="index" className="single">Trang chủ</a></li>
                  <li className="breadcrumb-item single-list" aria-current="page"><a href="javascript:void(0)" className="single active">Quên Password</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </section>

        <div className="login-area section-padding">
          <div className="container">
            <div className="row justify-content-center">
              <div className="col-xl-5 col-lg-6 col-md-8 col-sm-10">
                <div className="login-card">
                  <div className="logo mb-40">
                    <a href="index" className="mb-30 d-block">
                      <img width="180px" src={`${import.meta.env.VITE_BASE_URL}/assets/images/logo/LOGO-DEAH2-Photoroom.png`} alt="logo" className="changeLogo" />
                    </a>
                  </div>
                  <form onSubmit={handleSubmit(onSubmit)}>
                    <div className="contact-form mb-24">
                      <label className="contact-label">Email </label>
                      <input
                        type="email"
                        className="form-control"
                        {...register('email', { required: true })}
                      />
                    </div>
                    <button type="submit" className="btn-primary-fill justify-content-center w-100">
                      <span className="d-flex justify-content-center gap-6">
                        <span>Đặt lại mật khẩu</span>
                      </span>
                    </button>
                  </form>
                  <div className="login-footer">
                    <div className="create-account">
                      <p className="mb-0">
                        Quay trở lại |
                        <a href="login">
                          <span className="text-primary"> Đăng nhập</span>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      <Footer />
      <div className="progressParent" id="back-top">
        <svg className="backCircle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
          <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
      </div>
      <div className="search-overlay" />
    </div>
  );
};

export default Forgot;

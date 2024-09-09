import { useEffect, useState } from "react";
import Footer from "../components/Footer";
import Header from "../components/Header";
import { useForm } from "react-hook-form";
import { useNavigate } from "react-router-dom";

type PasswordInput = {
  old_password: string;
  new_password: string;
  confirm_password: string;
};

const Password = () => {
  const { register, handleSubmit, formState: { errors } } = useForm<PasswordInput>();
  const [message, setMessage] = useState('');
  const navigate = useNavigate();

  useEffect(() => {
    const userData = sessionStorage.getItem('user');
    if (!userData) {
      navigate('/login');
    }
  }, [navigate]);

  const onSubmit = async (data: PasswordInput) => {
    const { old_password, new_password, confirm_password } = data;

    if (new_password !== confirm_password) {
      setMessage('Mật khẩu mới và xác nhận mật khẩu không khớp.');
      return;
    }

    const userData = JSON.parse(sessionStorage.getItem('user') || '{}');

    try {
      const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}/api/client/user/change-pass`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
        body: JSON.stringify({
          id: userData.id,
          token: userData.token,
          old_password: old_password,
          new_password: new_password
        })
      });
      console.log(response);
      const resData = await response.json();
      console.log(resData);
      if (resData.message == "Success") {
        // setMessage(resData.message || 'Đổi mật khẩu thành công.');
        alert("Đổi mật khẩu thành công")
        navigate('/profile')
      } else {
        alert('Đổi thất bại ')
        navigate('/pass')
      }
    } catch (err) {
      setMessage('Có lỗi xảy ra. Vui lòng thử lại.');
    }

  };

  return (

    <div>
      <div>
        <Header status={undefined} />
        <main>
          {/* Breadcrumbs S t a r t */}
          <section className="breadcrumbs-area breadcrumb-bg">
            <div className="container">
              <h1 className="title wow fadeInUp" data-wow-delay="0.0s">Đăng nhập</h1>
              <div className="breadcrumb-text">
                <nav aria-label="breadcrumb" className="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                  <ul className="breadcrumb listing">
                    <li className="breadcrumb-item single-list"><a href="index" className="single">Trang chủ</a></li>
                    <li className="breadcrumb-item single-list" aria-current="page">
                      <a href="javascript:void(0)" className="single active">Đăng nhập</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </section>
          {/*/ End-of Breadcrumbs*/}
          {/* Đăng nhập area S t a r t  */}
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
               
                    <form onSubmit={handleSubmit(onSubmit)} action="#" method="POST">
                    {message && <p style={{ color: message.includes('thành công') ? 'green' : 'red' }}>{message}</p>}

                      <div className="contact-form mb-24">
                        <div className="position-relative contact-form mb-24">
                          <label className="contact-label">Mật khẩu cũ </label>
                          <input type="password" className="form-control contact-input password-input" placeholder="Nhập mật khẩu cũ" {...register('old_password', { required: 'Vui lòng nhập mật khẩu cũ.' })} />
                          {errors.old_password && <span style={{ color: "red" }}>{errors.old_password.message}</span>}
                      
                        </div>

                        <div className="position-relative contact-form mb-24">
                          <label className="contact-label"> Mật khẩu mới</label>
                          <input type="password" className="form-control contact-input password-input" placeholder="Nhập mật khẩu mới" {...register('new_password', { required: 'Vui lòng nhập mật khẩu mới.' })} />
                          {errors.new_password && <span style={{ color: "red" }}>{errors.new_password.message}</span>}
                        </div>

                        <div className="position-relative contact-form mb-24">
                          <label className="contact-label">Xác nhận mật khẩu</label>
                          <input type="password" className="form-control contact-input password-input" placeholder="Xác nhận mật khẩu mới" {...register('confirm_password', { required: 'Vui lòng xác nhận mật khẩu mới.' })} />
                          {errors.confirm_password && <span style={{ color: "red" }}>{errors.confirm_password.message}</span>}
                        </div>


                      </div>
                      <button type='submit' className='btn-primary-fill justify-content-center w-100 d-flex justify-content-center gap-6 '>Đăng nhập</button>

                    </form>

                    <div className="login-footer">
                      <div className="create-account">
                        <p>
                          Bạn có tài khoản không?
                          <a href="register">
                            <span className="text-primary">Đăng ký</span>
                          </a>
                        </p>
                     
                      </div>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {/*/ End-of Đăng nhập */}
        </main>
        {/* Footer S t a r t */}
        <Footer />
        <div className="progressParent" id="back-top">
          <svg className="backCircle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
          </svg>
        </div>
        <div className="search-overlay" />
      </div>

    </div>

  );
}

export default Password;

import React, { useState } from 'react';
import Header from './Header';
import Footer from './Footer';
import { useNavigate, useParams } from 'react-router-dom';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

const NewPassword = () => {
  const navigate = useNavigate();
  const { token } = useParams();
  const [password, setPassword] = useState('');
  const [password_confirm, setConfirmPassword] = useState('');
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    
    if (password !== password_confirm) {
      setError('Passwords do not match');
      console.log('Password:', password);
      console.log('Confirm Password:', password_confirm);
      return;
    }

    try {
      console.log('Token:', token);
      console.log('Password to send:', password);
      
      const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}/api/client/change-pass`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({ password,token,password_confirm })
      });

      console.log('Response Status:', response.status);
      console.log('Response Headers:', response.headers);
      
      const responseBody = await response.json();
      console.log('Response Body:', responseBody);

      if (response.ok) {
        toast.success('Chúc mừng bạn đã đổi mật khẩu thành công');
        navigate('/index-two');
        setSuccess('Thành công');
      } else {
        setError(responseBody.message || 'An error occurred');
        toast.error(responseBody.message || 'An error occurred');
      }
    } catch (error) {
      console.error('Error:', error);
      toast.error('Bạn gặp lỗi khi đổi mật khẩu mới');
    }
  };

  return (
    <div>
      <Header status={undefined}/>
      <main>
        {/* Breadcrumbs S t a r t */}
        <section className="breadcrumbs-area breadcrumb-bg">
          <div className="container">
            <h1 className="title wow fadeInUp" data-wow-delay="0.0s">Mật khẩu mới</h1>
            <div className="breadcrumb-text">
              <nav aria-label="breadcrumb" className="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                <ul className="breadcrumb listing">
                  <li className="breadcrumb-item single-list"><a href="index" className="single">Trang chủ</a></li>
                  <li className="breadcrumb-item single-list" aria-current="page"><a href="javascript:void(0)" className="single active">Mật khẩu mới</a></li>
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
                  <form onSubmit={handleSubmit}>
                    {/* Password */}
                    <div className="position-relative contact-form mb-24">
                      <label className="contact-label">Mật khẩu mới</label>
                      <input
                        type="password"
                        className="form-control contact-input password-input"
                        id="txtPasswordLogin"
                        placeholder="Enter Your Password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                      />
                      <i className="toggle-password ri-eye-line" />
                    </div>
                    {/* Confirm Password */}
                    <div className="position-relative contact-form mb-24">
                      <label className="contact-label">Xác nhận mật khẩu</label>
                      <input
                        type="password"
                        className="form-control contact-input password-input"
                        id="txtPasswordLogin2"
                        placeholder="Enter Your Confirm Password"
                        value={password_confirm}
                        onChange={(e) => setConfirmPassword(e.target.value)}
                      />
                      <i className="toggle-password ri-eye-line" />
                    </div>
                    {error && <p className="text-danger">{error}</p>}
                    {success && <p className="text-success">{success}</p>}
                    <button type="submit" className="btn-primary-fill justify-content-center w-100">
                      <span className="d-flex justify-content-center gap-6">
                        <span>Tiếp tục</span>
                      </span>
                    </button>
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
      <ToastContainer />
    </div>
  );
};

export default NewPassword;

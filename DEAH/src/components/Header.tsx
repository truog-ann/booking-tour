import { useEffect} from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import '../App.css';

const Header = ({ status }: { status: any }) => {
  

  const navigate = useNavigate();
  let userData:any = sessionStorage.getItem('user');
  if (userData) {
    userData = JSON.parse(userData);
  }
  useEffect(() => {
    userData = sessionStorage.getItem('user');
    if (userData) {
      userData = JSON.parse(userData); 
    }

  }, [status]);

  const handleLogout = () => {
    toast.success('Bạn đã đăng xuất thành công');
    sessionStorage.removeItem('user');
    localStorage.removeItem('token');
    navigate('/login');
  };


  return (
    <div>
      <header>
        <div className="header-area">
          <div className="main-header">
            {/* Header Top */}
            <div className="header-top">
              <div className="container">
                <div className="row">
                  <div className="col-lg-12">
                    <div className="top-menu-wrapper d-flex align-items-center justify-content-between">
                      {/* Top Left Side */}
                      <div className="top-header-left d-flex align-items-center">
                        {/* Logo */}
                        <div className="logo">
                          <Link to="/">
                            <img
                              width="180px"
                              src={`${import.meta.env.VITE_BASE_URL}/assets/images/logo/LOGO-DEAH2-Photoroom.png`}
                              alt="logo"
                              className="changeLogo"
                            />
                          </Link>
                        </div>
                        {/* Search box */}

                        {/* Mobile Device Search & Theme Mode */}
                        <div className="search-header-position d-block d-lg-none">
                          <div className="d-flex gap-15">
                            <div className="search-bar">

                            </div>
                          </div>
                        </div>
                      </div>
                      {/* Top Right Side */}
                      <div className="top-header-right">
                        {/* Contact us */}
                        <div className="contact-section">
                          <div className="circle-primary-sm">
                            <i className="ri-mail-line" />
                          </div>
                          <div className="info">
                            <p className="pera">Email bất cứ lúc nào</p>
                            <h4 className="title">
                              <a href="javascript:void(0)">deahbooking@gmail.com</a>
                            </h4>
                          </div>
                        </div>
                        <div className="contact-section">
                          <div className="circle-primary-sm">
                            <i className="ri-phone-line" />
                          </div>
                          <div className="info">
                            <p className="pera">Gọi bất cứ lúc nào</p>
                            <h4 className="title">
                              <a href="javascript:void(0)">0868928332</a>
                            </h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {/* Header Bottom */}
            <div className="header-bottom header-sticky">
              <div className="container">
                <div className="row">
                  <div className="col-lg-12">
                    <div className="menu-wrapper">
                      {/* Main-menu for desktop */}
                      <div className="main-menu d-none d-lg-block">
                        <nav className='my-3'>
                          <div className="d-flex justify-content-between align-items-center">
                            <ul className="listing" id="navigation">
                              <li className="single-list">
                                <Link to="/" className="single">Trang Chủ </Link>
                              </li>
                              <li className="single-list">
                                <Link to="/about" className="single">Về Chúng Tôi</Link>
                              </li>
                              <li className="single-list">
                                <Link to="/tour-list" className="single">Gói Du Lịch</Link>
                              </li>
                              <li className="single-list">
                                <Link to="/news" className="single">Tin tức</Link>
                              </li>
                              <li className="single-list">
                                <Link to="/contact" className="single">Liên hệ</Link>
                              </li>
                              <li className="single-list">
                              </li>
                              <li className="d-block d-lg-none">
                                <div className="header-right pl-15">
                                  <div className="d-flex align-items-center gap-12">
                                    <div className="lang">
                                      <i className="ri-global-line" />
                                    </div>
                                    <div className="divider gradient-divider" />
                                    <div className="money">
                                      {userData ? (
                                        <div className='d-flex'>
                                          <Link className='d-flex' to={'/profile'}>
                                            <h6 className='mt-10 mr-2 user-name '> {userData.name}</h6>

                                            {<img className='rounded-circle i' width={40} height={100} src={`${import.meta.env.VITE_BACKEND_URL}/` + (userData.avatar ? userData.avatar : '')} alt="" />}
                                          </Link>

                                        </div>

                                      ) : (
                                        <p className='mt-3'><Link to="/login" className="btn-secondary-sm">Đăng nhập</Link></p>
                                      )}
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </ul>
                            <div className="header-right">
                              {userData ? (
                                <div className='d-flex'>
                                  <Link className='d-flex' to={'/profile'}>
                                    <h6 className='mt-10 mr-2 user-name '> {userData.name}</h6>

                                    {<img className='rounded-circle i' width={40} height={100} src={`${import.meta.env.VITE_BACKEND_URL}/` + (userData.avatar ? userData.avatar : '')} alt="DEAH" />}
                                  </Link>

                                </div>

                              ) : (
                                <p className='mt-3'>Chào mừng, bạn vui lòng đăng nhập!</p>
                              )}
                              {!userData && (
                                <div className="sign-btn">
                                  <Link to="/login" className="btn-secondary-sm">Đăng nhập</Link>
                                </div>
                              )}
                              {userData && (
                                <div className="sign-btn">
                                  <a type='submit' className="btn-secondary-sm " onClick={handleLogout}>Đăng xuất</a>
                                </div>
                              )}
                            </div>


                          </div>
                        </nav>
                      </div>
                    </div>
                    {/* Mobile Menu */}
                    <div className="div">
                      <div className="mobile_menu" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {/* Search box */}
          <div className="search-container">
            <div className="top-section">
              <div className="search-icon">
                <i className="ri-search-line" />
              </div>
              <div className="modal-search-box">
                <input type="text" id="searchField" className="search-field" placeholder="Điểm đến, Agency, Country" />
                <button id="closeSearch" className="close-search-btn">
                  <kbd className="light-text"> THOÁT </kbd>
                </button>
              </div>
            </div>
            <div className="body-section">
              <div className="row">
                <div className="col-md-8">
                  <ul className="listing">
                    <li>
                      <h4 className="search-label">Gần đây</h4>
                    </li>
                    <li className="single-list">
                      <a href="tour-details">
                        <div className="search-flex">
                          <div className="content-img">
                            <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/gallery/search-img-1.jpeg`} alt="travello" />
                          </div>
                          <div className="content">
                            <h4 className="title line-clamp-1">
                              Dubai by Night City Tour với Fountain Show
                            </h4>
                            <p className="pera line-clamp-2">
                              buổi Tối Tuyệt Vời Esc apade Bắt Đầu Từ Madinat
                              jumeirah Đến Đài Phun Nước Dubai, tiếp theo là show nhạc
                              nước đặc sắc...
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li className="single-list">
                      <a href="tour-details">
                        <div className="search-flex">
                          <div className="content-img">
                            <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/gallery/search-img-2.jpeg`} alt="travello" />
                          </div>
                          <div className="content">
                            <h4 className="title line-clamp-1">
                              Tận Hưởng Ẩm Thực Trung Hoa Với Show Văn Hóa
                            </h4>
                            <p className="pera line-clamp-2">
                              buổi Tối Tuyệt Vời Esc apade Bắt Đầu Từ Madinat
                              jumeirah Đến Đài Phun Nước Dubai, tiếp theo là show nhạc
                              nước đặc sắc...
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li className="single-list">
                      <a href="tour-details">
                        <div className="search-flex">
                          <div className="content-img">
                            <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/gallery/search-img-1.jpeg`} alt="travello" />
                          </div>
                          <div className="content">
                            <h4 className="title line-clamp-1">
                              Chinh Phục Đỉnh Núi Himalayas
                            </h4>
                            <p className="pera line-clamp-2">
                              buổi Tối Tuyệt Vời Esc apade Bắt Đầu Từ Madinat
                              jumeirah Đến Đài Phun Nước Dubai, tiếp theo là show nhạc
                              nước đặc sắc...
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
                <div className="col-md-4">
                  <ul className="listing">
                    <li>
                      <h4 className="search-label">Yêu thích</h4>
                    </li>
                    <li className="single-list">
                      <a href="tour-details">
                        <div className="search-flex">
                          <div className="content-img">
                            <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/gallery/search-img-1.jpeg`} alt="travello" />
                          </div>
                          <div className="content">
                            <h4 className="title line-clamp-1">
                              Khám Phá Thành Phố Cổ Hội An
                            </h4>
                            <p className="pera line-clamp-2">
                              buổi Tối Tuyệt Vời Esc apade Bắt Đầu Từ Madinat
                              jumeirah Đến Đài Phun Nước Dubai, tiếp theo là show nhạc
                              nước đặc sắc...
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li className="single-list">
                      <a href="tour-details">
                        <div className="search-flex">
                          <div className="content-img">
                            <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/gallery/search-img-2.jpeg`} alt="travello" />
                          </div>
                          <div className="content">
                            <h4 className="title line-clamp-1">
                              Trải Nghiệm Văn Hóa Nhật Bản
                            </h4>
                            <p className="pera line-clamp-2">
                              buổi Tối Tuyệt Vời Esc apade Bắt Đầu Từ Madinat
                              jumeirah Đến Đài Phun Nước Dubai, tiếp theo là show nhạc
                              nước đặc sắc...
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li className="single-list">
                      <a href="tour-details">
                        <div className="search-flex">
                          <div className="content-img">
                            <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/gallery/search-img-1.jpeg`} alt="travello" />
                          </div>
                          <div className="content">
                            <h4 className="title line-clamp-1">
                              Tham Quan Vịnh Hạ Long
                            </h4>
                            <p className="pera line-clamp-2">
                              buổi Tối Tuyệt Vời Esc apade Bắt Đầu Từ Madinat
                              jumeirah Đến Đài Phun Nước Dubai, tiếp theo là show nhạc
                              nước đặc sắc...
                            </p>
                          </div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
    </div>
  );
};

export default Header;

import { Link } from "react-router-dom";

const Footer = () => {
    return (
        <div>
            <footer className="new_footer_area bg_color">
                <div className="new_footer_top">
                    <div className="container mx-9">
                        <div className="row">
                            <div className="col-lg-3 col-md-6">
                                <div className="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s">
                                    <h3 className="title f_600 t_color text-30">VỀ DEAH TOUR</h3>
                                    <ul className="list-unstyled f_list my-2">
                                        <li><a href="/tour-list">Đặt chỗ ngay</a></li>
                                        <li><a href="/about">Liên hệ chúng tôi</a></li>
                                        <li><a href="/contact">Trợ giúp</a></li>
                                        <li><a href="/about">Về Chúng Tôi</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div className="col-lg-3 col-md-6">
                                <div className="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" >
                                    <h3 className="title f_600 f_color text-30">DỊCH VỤ</h3>
                                    <ul className="list-unstyled f_list my-2">
                                        <li><a href="/tour-list">Khách sạn</a></li>
                                        <li><a href="/tour-list">Du lịch</a></li>
                                        <li><a href="news">Bài viết</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div className="col-lg-3 col-md-6">
                                <div className="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" >
                                    <h3 className="title f_600 t_color text-30">KHÁC</h3>
                                    <ul className="list-unstyled f_list my-2">
                                        <li><a href="/about">DEAH tour blog</a></li>
                                        <li><a href="/contact">Các chính sách</a></li>
                                        <li><a href="/contact">Các điều khoản</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div className="col-lg-3 col-md-6">
                                <div className="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" >
                                    <h3 className="title f_600 t_color text-30">DEAH VIỆT NAM</h3>
                                    <h5 className="titlee">Đi Muôn Nơi</h5>

                                    <Link to="/">
                                    <img
                                        width="400px"
                                        src={`${import.meta.env.VITE_BASE_URL}/assets/images/logo/LOGO-DEAH2-Photoroom.png`}
                                        alt="logo"
                                        className="changeLogo"
                                    />
                                    </Link>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="footer_bg">
                        <div className="footer_bg_one"></div>
                        <div className="footer_bg_two"></div>
                    </div>
                </div>
                <div className="footer_bottom">
                    <div className="container">
                        <div className="row align-items-center">
                            <div className="row align-items-center">
                                <div className="col-lg-6 col-sm-7 text-start">
                                    <p className="mb-0 f_400">© DEAH Inc.. 2024 All rights reserved.</p>
                                </div>
                                <div className="col-lg-6 col-sm-7 text-end">

                                    <div className="social-icons">
                                        <h5 className="title mx-2 my-2">Theo dõi tại:</h5>
                                        <a href="https://www.facebook.com/groups/deahtourinvietnam" target="_blank" className="social-icon">
                                            <i className="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://www.tiktok.com/@deahbookingtourinvietnam" target="_blank" className="social-icon">
                                            <i className="fab fa-tiktok"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer >
        </div >
    );
};

export default Footer;
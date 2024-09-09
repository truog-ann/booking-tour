
import Header from '../components/Header'
import Footer from '../components/Footer'
import { useNavigate } from 'react-router-dom'
import { useForm } from 'react-hook-form'
import { toast} from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
type Input = {
  email: string,
  password: number
}
const Login = () => {
  const navigate = useNavigate()
  const { register, handleSubmit , formState :{errors}} = useForm<Input>()
  function onSubmit(data: Input) {
    fetch(`${import.meta.env.VITE_BACKEND_URL}/api/client/user/login`, {
      method: "POST",
      headers: {
        "Content-Type": 'Application/json'
      },
      body: JSON.stringify(data)
    })
      .then(async (resdata) => {
        if (resdata.ok) {
          return resdata.json()
        } else {
          const message = await resdata.json();
          return new Promise(( reject) => {
            reject(message)
          })
        }
      })
      .then(resData => {
        console.log(resData);

        if (resData.data.token) {
          localStorage.setItem('token', resData.data.token);

          if (resData.data) {
            sessionStorage.setItem('user', JSON.stringify({
              avatar: resData.data.avatar,
              id: resData.data.id, 
              token: resData.data.token, 
              name: resData.data.name, 
              email: resData.data.email, 
              phone: resData.data.phone, 
              address: resData.data.address, 
              date_of_birth: resData.data.date_of_birth, 
              password: resData.data.password || '' }));
          }
          toast.success('Chúc mừng bạn đã đăng nhập thành công');
          navigate('/index-two');
        }else{
          toast.error('Hãy kiểm tra lại thông tin mật khẩu của bạn ')
        }
      })
    
  }
  return (
    <div>
      <div>
        <Header status={undefined}/>
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
                      <a href="/" className="mb-30 d-block">
                        <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/logo/LOGO-DEAH2-Photoroom.png`} alt="logo" className="changeLogo" width={250}/>
                      </a>
                    </div>
                    {/* Form */}
                    <form onSubmit={handleSubmit(onSubmit)} action="#" method="POST">
                      <div className="position-relative contact-form mb-24">
                        <label className="contact-label">Email </label>
                        <input  className="form-control contact-input" type="text" placeholder="Enter Your Email" {...register('email',
                          {
                            required : "Email của bạn đang trống",
                            pattern: {
                              value: /^\S+@\S+\.\S+$/,
                              message: "Không đúng định dạng email"
                            }
                          })} />
                          {errors.email && <span className='text-danger'>{errors.email?.message}</span>}
                      </div>
                      <div className="contact-form mb-24">
                        <div className="position-relative ">
                          <div className="d-flex justify-content-between aligin-items-center">
                            <label className="contact-label">Mật khẩu</label>
                            <a href="/forgot-pass"><span className="text-primary text-15"> Quên
                              mật khẩu?</span></a>
                          </div>
                          <input  type="password" className="form-control contact-input password-input" id="txtPasswordLogin" placeholder="Enter Password" {...register('password',
                            {required:'Mật khẩu của bạn đang bị trống',
                              minLength:{
                                value:6,
                                message:'mật khẩu không được nhỏ hơn 6 ký tự !'
                              }
                            }
                          )} />
                          {errors.password && <span className='text-danger'>{errors.password?.message}</span>}
                          <i className="toggle-password ri-eye-line" />
                        </div>
                      </div>
                      <button type='submit' className='btn-primary-fill justify-content-center w-100 d-flex justify-content-center gap-6 '>Đăng nhập</button>

                    </form>
                    <div className="login-footer">
                      <div className="create-account">
                        <p>
                          Bạn có tài khoản không?
                          <a href="/register">
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
  )
}

export default Login

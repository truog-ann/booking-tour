import './App.css';
import { Route, Routes, useLocation } from 'react-router-dom';
import { useState, useEffect } from 'react';
import About from './components/About';
import Contact from './components/Contact';
import Faq from './components/Faq';
import Forgot from './components/Forgot';
import Login from './AuthForm/Login';
import NewPassword from './components/NewPassword';
import NewsDetails from './components/NewsDetails';
import News from './components/News';
import Payment from './components/Payment';
import PrivacyPolicy from './components/PrivacyPolicy';
import Register from './AuthForm/Register';
import TermsCondition from './components/TermsCondition';
import TourDetails from './components/TourDetails';
import TourList from './components/TourList';
import Indextwo from './components/Indextwo';
import SlideShow from './FunctionComponentContext/SlideShow';
import ProfileUser from './AuthForm/ProfileUser';
import PaymentSuccess from './components/PaymentSuccess';
import Password from './AuthForm/Password';
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import PaymentPage from './components/PaymentPage';
import PaymentBanking from './components/PaymentBanking';
import Loading from './FunctionComponentContext/Loading';
import Lisbill2 from './components/Lisbill2';




function App() {
  const [loading, setLoading] = useState(false);
  const location = useLocation();

  useEffect(() => {
    setLoading(true);
    const timer = setTimeout(() => {
      setLoading(false);
    }, 1000); 
    return () => clearTimeout(timer);
  }, [location]);

  return (
    <>
      {loading && <Loading />}
      <Routes>
        <Route path="/" element={<Indextwo />} />
        <Route path="/index-two" element={<Indextwo />} />
        <Route path="/about" element={<About />} />
        <Route path="/tour-list" element={<TourList />} />
        <Route path="/tour-details/:slug" element={<TourDetails />} />
        <Route path="/news-details/:slug" element={<NewsDetails />} />
        <Route path="/payment/:slug" element={<Payment />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/forgot-pass" element={<Forgot />} />
        <Route path="/new-password/:token" element={<NewPassword />} />
        <Route path="/faq" element={<Faq />} />
        <Route path="/privacy-policy" element={<PrivacyPolicy />} />
        <Route path="/terms-condition" element={<TermsCondition />} />
        <Route path="/news" element={<News />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/slide" element={<SlideShow />} />
        <Route path='/paymentSuccess' element={<PaymentSuccess/>} />
        <Route path='/paymentpage' element={<PaymentPage/>}/>
        <Route path='/paymentbanking' element={<PaymentBanking/>}/>
        {/* user */}
        <Route path="/profile" element={<ProfileUser />} />
        <Route path="/listbill" element={<Lisbill2/>} />
        <Route path="/pass" element={<Password />} />
      
 
    
      </Routes>
      <ToastContainer />
    </>
  );
}

export default App;

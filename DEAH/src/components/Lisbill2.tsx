import { useEffect, useState } from 'react';
import '../App1.css';
import Header from './Header';
import Footer from './Footer';
import axios from 'axios';
import { format } from 'date-fns';
import StatusPayment from '../FunctionComponentContext/StatusPayment';
import SideBar from './SideBar';
import CurrencyFormatter from '../FunctionComponentContext/CurrencyFormatter';
import StatusTour from '../FunctionComponentContext/StatusTour';
import Popup from '../FunctionComponentContext/Popup';
import { useForm } from 'react-hook-form';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
const Lisbill2 = () => {
    const formattedDate = (currentDate: any) => format(currentDate, 'yyyy-MM-dd');
    
    const user = JSON.parse(sessionStorage.getItem("user")!);
    console.log(user);

    const [listbill, setListBill] = useState<any>([]);
    const [avatarUrl, setAvatarUrl] = useState<string>('');
    const [statusdelete, setstatusdelete] = useState<boolean>(false);
    const { reset } = useForm();
    const [userData, setUserData] = useState({
        id: '',
        avatar: '',
        name: '',
        email: '',
        phone: '',
        address: '',
        token: '',
        file: '',
        date_of_birth: ''
    });

    const perpage = 6;
    const [billCount, setBillCount] = useState<any>();
    const [totalPages, setTotalPages] = useState<any>();
    const [currentPageBills, setCurrentPageBills] = useState<any>();
    const [loading, setLoading] = useState(true);
    const [currentPage, setCurrentPage] = useState<any>(1);


    const changePage = (page:any) => {
        var start = (page - 1) * perpage;
        var end = start + perpage;
        var userListBillPage = listbill.slice(start, end);
        setCurrentPage(page);
        setCurrentPageBills(userListBillPage)
        return userListBillPage;
    }

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.post(`${import.meta.env.VITE_BACKEND_URL}/api/client/user/get-bookings`, {
                    id: user.id
                });
                console.log(response.data.data);
                var userListBill = response.data.data;
                setListBill(userListBill);
                setBillCount(userListBill.length);
                var pageNum = Math.ceil(billCount / perpage);
                var arrayLi = [];
                for (let index = 0; index < pageNum; index++) {
                    arrayLi.push(<li className="page-item m-1" aria-current="page" key={index + 1}>
                        <button className="page-link btn" disabled={index + 1 === currentPage} onClick={() => changePage(index + 1)}>{index + 1}</button>
                    </li>)
                }
                setTotalPages(arrayLi);
                var userListBillPage = changePage(currentPage);
                setCurrentPageBills(userListBillPage);
                setLoading(false);

            } catch (error) {
                console.error('Có lỗi xảy ra khi lấy dữ liệu đơn hàng');
                setLoading(false);
            }
        };

        const Data = sessionStorage.getItem('user');
        if (Data) {
            const user = JSON.parse(Data);
            setUserData(user);
            setAvatarUrl(user.avatar ? `${import.meta.env.VITE_BACKEND_URL}`+'/'+ user.avatar : '');
            reset(user);
        }
        fetchData();
    }, [reset, statusdelete, loading, currentPage]);

    const handleDelete = async (code: any) => {

        if (window.confirm('Bạn có chắc chắn chắn hủy đơn?')) {
            setLoading(true);
            try {

                const response = await axios.post(`${import.meta.env.VITE_BACKEND_URL}/api/client/user/booking/update`, {
                    action: 'cancel',
                    booking_code: code,
                });
                const status = response.data.status;
                if (status === 200) {
                    toast.success('Đơn hàng đã hủy thành công');
                } else {
                    toast.error('Đơn hàng không thể hủy');
                }
                setstatusdelete(!statusdelete)
            } catch (error) {
                toast.error('Có lỗi xảy ra khi hủy đơn hàng');
            }
        }

    };

    const handleRepay = async (item: any) => {

        let response = await axios.post(`${import.meta.env.VITE_BACKEND_URL}/api/client/repay`, item);
        window.location.href = response.data.data;

    }
    if (loading) {
        return (
            <div className="loading">
                <div className="spinner">
                    <div className="blob blob-0" />
                </div>
            </div>
        );
    }
    return (
        <div>
            <Header status={undefined} />
            <div className="container">
                <div className="view-account">
                    <section className="module">
                        <div className="module-inner">
                            <SideBar status={true} userData={userData} avatarUrl={avatarUrl} />
                            <div className="content-panel">
                                <div className="">
                                    <section className="table__header">
                                        <h1>Danh Sách Đơn hàng</h1>
                                       
                                    </section>
                                    <table className='table__body'>
                                        <thead>
                                            <tr>
                                                <th>STT <span className=""></span></th>
                                                <th>Mã Tour <span className=""></span></th>
                                                <th>Giá <span className=""></span></th>
                                                <th>Ngày Đặt <span className=""></span></th>
                                                <th>Trạng thái Thanh Toán <span className=""></span></th>
                                                <th>Trạng thái Đơn Hàng <span className=""></span></th>
                                                <th>Hành Động <span className=""></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {currentPageBills.map((item: any, index: number) => (
                                                <tr key={item.id}>
                                                    <td>{index + 1}</td>
                                                    <td>{item.booking_code}</td>
                                                    <td><CurrencyFormatter amount={item.total_price} /></td>
                                                    <td>{formattedDate(new Date(item.created_at))}</td>
                                                    <td><StatusPayment status={item.status_payment} /></td>
                                                    <td><StatusTour status={item.status_tour} /></td>
                                                    <td className='g-2 d-flex'>
                                                        <Popup item={item} />
                                                        {item.status_tour === 0 ? (
                                                            <i
                                                                role='button'
                                                                onClick={() => handleDelete(item.booking_code)}
                                                                className="ri-delete-bin-7-fill text-danger fs-4"
                                                            />
                                                        ) : ''}
                                                        {item.status_payment == 0 ? <i role='button' onClick={() => handleRepay(item)} className="ri-refund-2-line text-success ml-2 fs-4"></i> : ''}
                                                    </td>
                                                </tr>
                                            ))}


                                        </tbody>

                                    </table>
                                    <nav aria-label="Page navigation">
                                        <ul
                                            className="pagination"
                                        >

                                            {totalPages}

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <Footer />
            <ToastContainer />
        </div>
    );
}

export default Lisbill2;



const StatusPayment = ({status}:{status:any}) => {
  let alertClass = 'badge bg-';
  let statusinf = "";

  switch (status) {
    case 0:
      statusinf = 'Đơn Mới';
      alertClass += 'warning ';
      break;
    case 1:
      statusinf = 'Hoàn Thành';
      alertClass += 'success';
      break;
    case 2:
      statusinf = 'Đã Hủy';
      alertClass += 'danger';
      break;
    default:
      statusinf = '';
      alertClass = '';
  }

  return (
    <div className={alertClass} role="alert" >
      {statusinf}
    </div>
  );
};


export default StatusPayment

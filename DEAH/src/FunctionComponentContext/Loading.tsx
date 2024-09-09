// Loading.js

import '../App.css'; // Tùy chỉnh CSS cho loading nếu cần

const Loading = () => {
  return (
    <div className="loading">
      <div className="spinner">
        <div className="blob blob-0" />
      </div>
    </div>
  );
}

export default Loading;

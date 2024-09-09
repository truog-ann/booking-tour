
import 'react-slideshow-image/dist/styles.css';
import { Slide } from 'react-slideshow-image';
import '../App.css';
import { useQuery } from '@tanstack/react-query';
import axios from 'axios';

const SlideShow = () => {
  const api = 'http://localhost:3000/image';
  
  const { data, isLoading, error } = useQuery({
    queryKey: ['KEY_IMG'],
    queryFn: async () => {
      const { data } = await axios.get(api);
      return data;
    },
  });

  if (isLoading) return <div>Loading...</div>;
  if (error) return <div>Error loading images</div>;

  const groupImages = (images:any, groupSize:any) => {
    const groups = [];
    for (let i = 0; i < images.length; i += groupSize) {
      groups.push(images.slice(i, i + groupSize));
    }
    return groups;
  };

  const groupedImages = groupImages(data, 4);

  return (
    <div className="slideshow-container">
      <Slide>
        {groupedImages.map((group, index) => (
          <div className="each-slide-effect" key={index}>
            <div className="image-group">
              {group.map((image:any, subIndex:any) => (
                <div className="image-item" key={subIndex}>
                  <h1>{image.title}</h1>
                  <img src={image.img} alt={image.title} />
                  <p>{image.description}</p>
                  <button className='btn btn-success'>Detai</button>
                </div>
                
              ))}
            </div>
          </div>
        ))}
      </Slide>
    </div>
  );
};

export default SlideShow;

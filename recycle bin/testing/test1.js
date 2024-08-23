// for standard room

const initSlider1 = () => {
    const imageList = document.querySelector(".slide-wrapper1 .list-container");
    const slideButtons = document.querySelectorAll(".slide-wrapper1 .slide-button1");
    const sliderScrollbar = document.querySelector(".container .slider-scrollbar1");
    const scrollbarThumb = sliderScrollbar.querySelector(".scrollbar-thumb1");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

    //handle  scrollbar thumb drag
    scrollbarThumb.addEventListener("mousedown", (e) => {
        const startX = e.clientX;
        const thumbPosition = scrollbarThumb.offsetLeft;

        //update thumb position on mouse move
        const handleMouseMove = (e) => {
            const deltaX = e.clientX - startX;
            const newThumbPosition = thumbPosition + deltaX;
            const maxThumbPosition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;

            const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newThumbPosition));
            const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;

            scrollbarThumb.style.left = `${boundedPosition}px`;
            imageList.scrollLeft =  scrollPosition;    
        }

        //remove event listener on mouse up
        const handleMouseUp = () => {
            document.removeEventListener("mousemove", handleMouseMove);
            document.removeEventListener("mouseup", handleMouseUp);
        }

        //add event listeners for drag interaction
        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handleMouseUp);
    });



    //slide image according to the slide button clicks
    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            const scrollAmount = imageList.clientWidth * direction;
            imageList.scrollBy({left: scrollAmount, behavior: "smooth"});
        });
    });

    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "block";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
    }
    
    //update scrollbar thumb position based on scroll

    const updateScrollThumbPosition = () => {
        const scrollPosition = imageList.scrollLeft;
        const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
        scrollbarThumb.style.left = `${thumbPosition}px`;
    }

    imageList.addEventListener("scroll", () => {
        handleSlideButtons();
        updateScrollThumbPosition();
    });
}





























// for superior room

const initSlider2 = () => {
    const imageList = document.querySelector(".slide-wrapper2 .list-container");
    const slideButtons = document.querySelectorAll(".slide-wrapper2 .slide-button2");
    const sliderScrollbar = document.querySelector(".container .slider-scrollbar2");
    const scrollbarThumb = sliderScrollbar.querySelector(".scrollbar-thumb2");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

    //handle  scrollbar thumb drag
    scrollbarThumb.addEventListener("mousedown", (e) => {
        const startX = e.clientX;
        const thumbPosition = scrollbarThumb.offsetLeft;

        //update thumb position on mouse move
        const handleMouseMove = (e) => {
            const deltaX = e.clientX - startX;
            const newThumbPosition = thumbPosition + deltaX;
            const maxThumbPosition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;

            const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newThumbPosition));
            const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;

            scrollbarThumb.style.left = `${boundedPosition}px`;
            imageList.scrollLeft =  scrollPosition;    
        }

        //remove event listener on mouse up
        const handleMouseUp = () => {
            document.removeEventListener("mousemove", handleMouseMove);
            document.removeEventListener("mouseup", handleMouseUp);
        }

        //add event listeners for drag interaction
        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handleMouseUp);
    });



    //slide image according to the slide button clicks
    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            const scrollAmount = imageList.clientWidth * direction;
            imageList.scrollBy({left: scrollAmount, behavior: "smooth"});
        });
    });

    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "block";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
    }
    
    //update scrollbar thumb position based on scroll

    const updateScrollThumbPosition = () => {
        const scrollPosition = imageList.scrollLeft;
        const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
        scrollbarThumb.style.left = `${thumbPosition}px`;
    }

    imageList.addEventListener("scroll", () => {
        handleSlideButtons();
        updateScrollThumbPosition();
    });
}











// for family room

const initSlider3 = () => {
    const imageList = document.querySelector(".slide-wrapper3 .list-container");
    const slideButtons = document.querySelectorAll(".slide-wrapper3 .slide-button3");
    const sliderScrollbar = document.querySelector(".container .slider-scrollbar3");
    const scrollbarThumb = sliderScrollbar.querySelector(".scrollbar-thumb3");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

    //handle  scrollbar thumb drag
    scrollbarThumb.addEventListener("mousedown", (e) => {
        const startX = e.clientX;
        const thumbPosition = scrollbarThumb.offsetLeft;

        //update thumb position on mouse move
        const handleMouseMove = (e) => {
            const deltaX = e.clientX - startX;
            const newThumbPosition = thumbPosition + deltaX;
            const maxThumbPosition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;

            const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newThumbPosition));
            const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;

            scrollbarThumb.style.left = `${boundedPosition}px`;
            imageList.scrollLeft =  scrollPosition;    
        }

        //remove event listener on mouse up
        const handleMouseUp = () => {
            document.removeEventListener("mousemove", handleMouseMove);
            document.removeEventListener("mouseup", handleMouseUp);
        }

        //add event listeners for drag interaction
        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handleMouseUp);
    });



    //slide image according to the slide button clicks
    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            const scrollAmount = imageList.clientWidth * direction;
            imageList.scrollBy({left: scrollAmount, behavior: "smooth"});
        });
    });

    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "block";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
    }
    
    //update scrollbar thumb position based on scroll

    const updateScrollThumbPosition = () => {
        const scrollPosition = imageList.scrollLeft;
        const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
        scrollbarThumb.style.left = `${thumbPosition}px`;
    }

    imageList.addEventListener("scroll", () => {
        handleSlideButtons();
        updateScrollThumbPosition();
    });
}















// forbarkadahan room

const initSlider4 = () => {
    const imageList = document.querySelector(".slide-wrapper4 .list-container");
    const slideButtons = document.querySelectorAll(".slide-wrapper4 .slide-button4");
    const sliderScrollbar = document.querySelector(".container .slider-scrollbar4");
    const scrollbarThumb = sliderScrollbar.querySelector(".scrollbar-thumb4");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

    //handle  scrollbar thumb drag
    scrollbarThumb.addEventListener("mousedown", (e) => {
        const startX = e.clientX;
        const thumbPosition = scrollbarThumb.offsetLeft;

        //update thumb position on mouse move
        const handleMouseMove = (e) => {
            const deltaX = e.clientX - startX;
            const newThumbPosition = thumbPosition + deltaX;
            const maxThumbPosition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;

            const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newThumbPosition));
            const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;

            scrollbarThumb.style.left = `${boundedPosition}px`;
            imageList.scrollLeft =  scrollPosition;    
        }

        //remove event listener on mouse up
        const handleMouseUp = () => {
            document.removeEventListener("mousemove", handleMouseMove);
            document.removeEventListener("mouseup", handleMouseUp);
        }

        //add event listeners for drag interaction
        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handleMouseUp);
    });



    //slide image according to the slide button clicks
    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            const scrollAmount = imageList.clientWidth * direction;
            imageList.scrollBy({left: scrollAmount, behavior: "smooth"});
        });
    });

    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "block";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
    }
    
    //update scrollbar thumb position based on scroll

    const updateScrollThumbPosition = () => {
        const scrollPosition = imageList.scrollLeft;
        const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
        scrollbarThumb.style.left = `${thumbPosition}px`;
    }

    imageList.addEventListener("scroll", () => {
        handleSlideButtons();
        updateScrollThumbPosition();
    });
}
















// exclusive suite

const initSlider5 = () => {
    const imageList = document.querySelector(".slide-wrapper5 .list-container");
    const slideButtons = document.querySelectorAll(".slide-wrapper5 .slide-button5");
    const sliderScrollbar = document.querySelector(".container .slider-scrollbar5");
    const scrollbarThumb = sliderScrollbar.querySelector(".scrollbar-thumb5");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

    //handle  scrollbar thumb drag
    scrollbarThumb.addEventListener("mousedown", (e) => {
        const startX = e.clientX;
        const thumbPosition = scrollbarThumb.offsetLeft;

        //update thumb position on mouse move
        const handleMouseMove = (e) => {
            const deltaX = e.clientX - startX;
            const newThumbPosition = thumbPosition + deltaX;
            const maxThumbPosition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;

            const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newThumbPosition));
            const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;

            scrollbarThumb.style.left = `${boundedPosition}px`;
            imageList.scrollLeft =  scrollPosition;    
        }

        //remove event listener on mouse up
        const handleMouseUp = () => {
            document.removeEventListener("mousemove", handleMouseMove);
            document.removeEventListener("mouseup", handleMouseUp);
        }

        //add event listeners for drag interaction
        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handleMouseUp);
    });



    //slide image according to the slide button clicks
    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            const scrollAmount = imageList.clientWidth * direction;
            imageList.scrollBy({left: scrollAmount, behavior: "smooth"});
        });
    });

    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "block";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
    }
    
    //update scrollbar thumb position based on scroll

    const updateScrollThumbPosition = () => {
        const scrollPosition = imageList.scrollLeft;
        const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
        scrollbarThumb.style.left = `${thumbPosition}px`;
    }

    imageList.addEventListener("scroll", () => {
        handleSlideButtons();
        updateScrollThumbPosition();
    });
}















window.addEventListener("load", initSlider1);
window.addEventListener("load", initSlider2);
window.addEventListener("load", initSlider3);
window.addEventListener("load", initSlider4);
window.addEventListener("load", initSlider5);
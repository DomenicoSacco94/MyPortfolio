function [ OVER_PROD ] = SUM_MULT( A,B )
%UNTITLED4 Summary of this function goes here
%   Detailed explanation goes here
%Overlaps two images, averages them
one_red=A(:,:,1);
one_green=A(:,:,2);
one_blue=A(:,:,3);
two_red=B(:,:,1);
two_green=B(:,:,2);
two_blue=B(:,:,3);
[M,N]=size(A);
[P,Q]=size(B);
N=N/3;
Q=Q/3;
SUM(:,:,1)=double(one_red(1:min(M,P),1:min(N,Q))).*double(two_red(1:min(M,P),1:min(N,Q)));
SUM(:,:,2)=double(one_green(1:min(M,P),1:min(N,Q))).*double(two_green(1:min(M,P),1:min(N,Q)));
SUM(:,:,3)=double(one_blue(1:min(M,P),1:min(N,Q))).*double(two_blue(1:min(M,P),1:min(N,Q)));
SUM2=double(SUM);
SUM2=SUM2/(max(max(SUM2(:)))-min(min(SUM2(:))));
figure,imshow(SUM2)
OVER_PROD=reshape(SUM2,[min(M,P),min(N,Q),3]);
end


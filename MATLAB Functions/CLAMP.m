function [ A ] = CLAMP( A, LOW, HIGH )
%UNTITLED10 Summary of this function goes here
%   Detailed explanation goes here
[M,N]=size(A);
for i=1:M
    for j=1:N
        if A(i,j)<LOW
            A(i,j)=0;
        end
        if A(i,j)>HIGH
            A(i,j)=255;
        end
    end
end
end


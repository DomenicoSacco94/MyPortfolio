#define _CRT_SECURE_NO_DEPRECATE
#define WINDOW_SIZE 44100
#define NUM_COEFFICIENTS 50
#define GRANULARITY int(WINDOW_SIZE/NUM_COEFFICIENTS)
#include <iostream>
#include <cstdio>
#include <cstdlib>
#include <cmath>
#include "string.h"
#include <string>
#include <complex>
#include <cassert>
#include <valarray>
#include <windows.h> 

using namespace std;

const double PI = 3.141592653589793238460;

typedef std::complex<double> Complex;
typedef std::valarray<Complex> CArray;

short int* low_pass(short int* x) {

	int *y = new int[WINDOW_SIZE];
	short int *result = new short int[WINDOW_SIZE];
	memset(y, 0, sizeof(int) * WINDOW_SIZE);
	memset(y, 0, sizeof(short int) * WINDOW_SIZE);

	//FIRST FILTER
	//y[n] = (1 * x[n - 1]) / 2.749
		//+ (1 * x[n - 0]) / 2.749
		//+ (0.7490960131 * y[n - 1]) / 2.749;

	//SECOND FILTER
	//y[n] = (1 * x[n - 2]) / 4.933
		//+ (2 * x[n - 1]) / 4.933
		//+ (1 * x[n - 0]) / 4.933
		//+ (-0.6683689946 * y[n - 2]) / 4.933
		//+ (1.6010923942 * y[n - 1]) / 4.933;

	//THIRD FILTER
	//y[n] = (1 * x[n - 2]) / 4.9815
		//+ (2 * x[n - 1]) / 4.9815
		//+ (1 * x[n - 0]) / 4.9815
		//+ (-0.8175124034 * y[n - 2]) / 4.9815
		//+ (1.7990964095 * y[n - 1]) / 4.9815;

	//FOURTH FILTER
	//y[n] = (1 * x[n - 2]) / 4.995
		//+ (2 * x[n - 1]) / 4.995
		//+ (1 * x[n - 0]) / 4.995

		//+ (-0.9040596527 * y[n - 2]) / 4.995
		//+ (1.8992193292 * y[n - 1]) / 4.995;

	//FIFTH FILTER
	//y[n] = (1 * x[n - 3]) / 8.993
		//+ (3 * x[n - 2]) / 8.993
		//+ (3 * x[n - 1]) / 8.993
		//+ (1 * x[n - 0]) / 8.993
		//+ (0.8670420126 * y[n - 3]) / 8.993
		//+ (-2.7247727381 * y[n - 2]) / 8.993
		//+ (2.8573925172 * y[n - 1]) / 8.993;

	//SIXTH FILTER
	//y[n] = (1 * x[n - 3]) / 9
		//+ (3 * x[n - 2]) / 9
		//+ (3 * x[n - 1]) / 9
		//+ (1 * x[n - 0]) / 9
		//+ (0.9311614800 * y[n - 3]) / 9
		//+ (-2.8598902349 * y[n - 2]) / 9
		//+ (2.9286849853 * y[n - 1]) / 9;
	y[0] = x[0]/ 16.999;
	y[1] = x[1] / 16.999;
	y[2] = y[2] / 16.999;

	for (int n = 3; n < WINDOW_SIZE; n++)
	{
		y[n] = (1 * x[n - 4]) / 16.999
			+ (4 * x[n - 3]) / 16.999
			+ (6 * x[n - 2]) / 16.999
			+ (4 * x[n - 1]) / 16.999
			+ (1 * x[n - 0]) / 16.999
			+ (-0.9110219631 * y[n - 4]) / 16.999
			+ (3.7289769642 * y[n - 3]) / 16.999
			+ (-5.7247764514 * y[n - 2]) / 16.999
			+ (3.9068199063 * y[n - 1]) / 16.999;
	}

	for (int n = 1; n < WINDOW_SIZE; n++)
	{
		result[n] = y[n];
	}
	return result;
}

short int* l_p(short int* x, int times) {
	for (int i = 0; i < times; i++) {
		x = low_pass(x);
	}
	return x;
}

short int* add_noise(short int* window) {
	short int *noised = new short int[WINDOW_SIZE];
	memset(noised, 0, sizeof(short int) * WINDOW_SIZE);
	for (int yy = 1; yy < WINDOW_SIZE; yy++)
	{
		noised[yy] = window[yy] + rand()%5000 - 2500;
	}
	return noised;
}


struct wav_header_t
{
	char chunkID[4]; //"RIFF" = 0x46464952
	unsigned long chunkSize; //28 [+ sizeof(wExtraFormatBytes) + wExtraFormatBytes] + sum(sizeof(chunk.id) + sizeof(chunk.size) + chunk.size)
	char format[4]; //"WAVE" = 0x45564157
	char subchunk1ID[4]; //"fmt " = 0x20746D66
	unsigned long subchunk1Size; //16 [+ sizeof(wExtraFormatBytes) + wExtraFormatBytes]
	unsigned short audioFormat;
	unsigned short numChannels;
	unsigned long sampleRate;
	unsigned long byteRate;
	unsigned short blockAlign;
	unsigned short bitsPerSample;
	//[WORD wExtraFormatBytes;]
	//[Extra format bytes]
};

//Chunks
struct chunk_t
{
	char ID[4]; //"data" = 0x61746164
	unsigned long size;  //Chunk data bytes
};

void WavReader(const char* fileName, const char* data_train, const char* data_train2, float coefficient)
{
	FILE *fin = fopen(fileName, "rb");
	FILE *fout_wav_noisy = fopen(data_train, "wb");
	FILE *fout_wav = fopen(data_train2, "wb");
	//Read WAV header
	wav_header_t header;
	fread(&header, sizeof(header), 1, fin);
	fwrite(&header, sizeof(header), 1, fout_wav);
	fwrite(&header, sizeof(header), 1, fout_wav_noisy);
	//Reading file
	chunk_t chunk;
	//printf("id\t" "size\n");
	//go to data chunk
	while (true)
	{
		fread(&chunk, sizeof(chunk), 1, fin);
		fwrite(&chunk, sizeof(chunk), 1, fout_wav);
		fwrite(&chunk, sizeof(chunk), 1, fout_wav_noisy);
		//printf("%c%c%c%c\t" "%li\n", chunk.ID[0], chunk.ID[1], chunk.ID[2], chunk.ID[3], chunk.size);
		if (*(unsigned int *)&chunk.ID == 0x61746164)
			break;
		//skip chunk data bytes
		fseek(fin, chunk.size, SEEK_CUR);
		fseek(fout_wav, chunk.size, SEEK_CUR);
		fseek(fout_wav_noisy, chunk.size, SEEK_CUR);
	}

	//Number of samples
	int sample_size = header.bitsPerSample / 8;
	int samples_count = chunk.size * 8 / header.bitsPerSample;
	printf("Samples count = %i\n", samples_count);
	short int *window = new short int[WINDOW_SIZE];
	memset(window, 0, sizeof(short int) * WINDOW_SIZE);
	//Reading data
	//short int average = calc_average(value, samples_count);
	int total_windows = samples_count / WINDOW_SIZE - 1;
	for (int i = 0; i < total_windows; i++)
	{
		int k = 0;

		for (int j = 0; j < WINDOW_SIZE; j = j++)
		{
			fread(&window[j], sample_size, 1, fin);
		}

		window = add_noise(window);

		for (int j = 0; j < WINDOW_SIZE; j = j++)
		{
			fwrite(&window[j], sample_size, 1, fout_wav_noisy);
		}

		cout << window[10] << endl;

		window = l_p(window,10);

		cout << window[10] << endl;

		for (int j = 0; j < WINDOW_SIZE; j = j++)
		{
			fwrite(&window[j], sample_size, 1, fout_wav);
		}

		cout << i << " window" << endl;
	}

	fclose(fin);
	fclose(fout_wav);
	fclose(fout_wav_noisy);
}

int main()
{

	string path = "C:\\Users\\domis\\Desktop\\Filter_Test\\prova.wav";
	string filePath = path + "";
	const char* sc = filePath.c_str();

	WavReader(sc, "noisy.wav", "low_passed.wav", 0);

	system("pause");
	return 0;
}